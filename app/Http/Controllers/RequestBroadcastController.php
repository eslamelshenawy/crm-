<?php

namespace App\Http\Controllers;

use App\InterestedRequest;
use App\Project;
use App\RequestBroadcast as Model;
use App\User;
use Auth;
use Illuminate\Http\Request as Request;
use OneSignal;
use Validator;

class RequestBroadcastController extends Controller {
	public function __construct() {
		$this->middleware(function ($request, $next) {
			return $next($request);
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$request = Model::paginate(10);
		return view('admin.requests_broadcast.index', ['title' => trans('admin.all_requests'), 'index' => $request]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.requests_broadcast.create', ['title' => trans('admin.add_request')]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$rules = [
			'notes' => 'required|min:3',
		];
		$validator = Validator::make($request->all(), $rules);
		$validator->SetAttributeNames([
			'notes' => trans('admin.notes'),

		]);

		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		} else {
			$req = new Model;
			$req->with(['unittype', 'loc', 'project', 'user']);
			$req->lead_id = $request->lead;
			$req->location = $request->location;
			$req->down_payment = $request->down_payment;
			$req->area_from = $request->area_from;
			$req->area_to = $request->area_to;
			$req->price_from = $request->price_from;
			$req->price_to = $request->price_to;
			$req->date = $request->date;
			$req->unit_type = $request->unit_type;
			$req->project_id = $request->project_id;
			$req->lat = $request->lat;
			$req->lng = $request->lng;
			$req->zoom = $request->zoom;
			$req->type = $request->buyer_seller;
			if ($request->unit_type != 'land') {
				$req->request_type = $request->request_type;
				$req->unit_type_id = $request->unit_type_id;
			} else {
				$req->request_type = 'land';
				$req->unit_type_id = 0;
			}

			if ($request->request_type != 'new_home' or $request->request_type != 'land') {
				$req->rooms_from = $request->rooms_from;
				$req->rooms_to = $request->rooms_to;
				$req->bathrooms_from = $request->bathrooms_from;
				$req->bathrooms_to = $request->bathrooms_to;
			}
			$req->notes = $request->notes;
			$req->user_id = Auth::user()->id;
			$req->save();

			$notify = new \App\AdminNotification;
			$notify->type = 'broadcast';
			$notify->type_id = $req->id;
			$notify->status = 0;
			$notify->user_id = Auth::user()->id;
			$notify->assigned_to = 0;
			$notify->save();
			$users = User::all();
			$url = url(adminPath() . '/requests_broadcast/' . $req->id);
			$message = "New Request: \"$request->notes\" is added to all.";
			$data = array();
			$data['data'] = $req->toArray();
			$data['activityToBeOpened'] = "broadcast";
			foreach ($users as $user) {
				foreach ($user->player as $p) {
					$url2 = $url;
					if ($p->device == "ios" || $p->device == "android") {
						$url2 = null;
					}
					sendOne($message, $p->player_id, $url2, $data);
				}
			}

			$old_data = json_encode($req);
			LogController::add_log(
				__('admin.created', [], 'ar') . ' ' . __('admin.request', [], 'ar'),
				__('admin.created', [], 'en') . ' ' . __('admin.request', [], 'en'),
				'requests_broadcast',
				$req->id,
				'create',
				auth()->user()->id,
				$old_data
			);

			session()->flash('success', trans('admin.created'));
			return redirect(adminPath() . '/requests_broadcast/' . $req->id);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$request = Model::find($id);
		return view('admin.requests_broadcast.show', ['title' => trans('admin.all_requests'), 'req' => $request]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$request = Model::find($id)->first();

		return view('admin.requests_broadcast.edit', ['title' => trans('admin.edit_lead'), 'data' => $request]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $asd) {
		$rules = [
			'lead' => 'required|max:191',
			'unit_type' => 'required|max:191',
			'price_from' => 'required|numeric|min:0',
			'price_to' => 'required|numeric|min:' . $request->price_from . '',
			'date' => 'required|max:191',
			'description' => 'required',

		];
		$validator = Validator::make($request->all(), $rules);
		$validator->SetAttributeNames([
			'lead' => trans('admin.lead'),
			'unit_type' => trans('admin.unit_type'),
			'price_from' => trans('admin.price') . ' ' . trans('admin.from'),
			'price_to' => trans('admin.price') . ' ' . trans('admin.to'),
			'date' => trans('admin.date'),
			'description' => trans('admin.description'),
		]);

		if ($validator->fails()) {
			return back()->withInput()->withErrors($validator);
		} else {
			$lead = Model::with(['unittype', 'loc', 'project', 'user'])->find($asd);

			$lead->lead_id = "-1";
			$lead->unit_type_id = $request->unit_type;
			$lead->price_from = $request->price_from;
			$lead->price_to = $request->price_to;
			$lead->date = $request->date;
			$lead->notes = $request->description;
			$lead->type = $request->type;
			$lead->save();
			$notify = new \App\AdminNotification;
			$notify->type = 'broadcast';
			$notify->type_id = $asd;
			$notify->status = 0;
			$notify->user_id = Auth::user()->id;
			$notify->assigned_to = 0;
			$notify->save();
			$users = User::all();
			$url = url(adminPath() . '/requests_broadcast/' . $request->id);
			$message = "Request Updated: \"$request->description\" to all.";
			$data = array();
			$data['data'] = $lead->toArray();
			$data['activityToBeOpened'] = "broadcast";
			foreach ($users as $user) {
				foreach ($user->player as $p) {
					$url2 = $url;
					if ($p->device == "ios" || $p->device == "android") {
						$url2 = null;
					}
					sendOne($message, $p->player_id, $url2, $data);
				}
			}
			return redirect(adminPath() . '/requests_broadcast');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($request) {
		$data = Model::find($request);

		$old_data = json_encode($data);
		LogController::add_log(
			__('admin.deleted', [], 'ar') . ' ' . __('admin.request', [], 'ar'),
			__('admin.deleted', [], 'en') . ' ' . __('admin.request', [], 'en'),
			'requests_broadcast',
			$data->id,
			'delete',
			auth()->user()->id,
			$old_data
		);

		$data->delete();
		session()->flash('success', trans('admin.deleted'));
		return redirect(adminPath() . '/requests_broadcast');
	}

	public function interestedRequest($unit, $req) {
		if (InterestedRequest::where('unit_id', $unit)->where('request_id', $req)->count()) {
			$interests = InterestedRequest::where('unit_id', $unit)->where('request_id', $req)->get();
			foreach ($interests as $interest) {
				$interest->delete();
			}
			session()->flash('success', __('admin.removed'));
		} else {
			$interest = new InterestedRequest;
			$interest->unit_id = $unit;
			$interest->request_id = $req;
			$interest->save();
			session()->flash('success', __('admin.added'));
		}

		session()->flash('return_to_suggestions', 1);
		return back();
	}

	public function getProjects(Request $r) {
		$projects = Project::where('developer_id', $r->id)->get();
		return view('admin.requests_broadcast.get_projects', compact('projects'));
	}
}
