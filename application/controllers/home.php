<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	
	function __construct()
	{
		parent::__construct();
        $this->load->model('HomeModel', 'model');
	}

	public function index()
	{
		$optSelect = [
			"orderby" => [["testi_id", "desc"]]
		];
		$data['testi'] = $this->model->select('testimonial', $optSelect);
		
		$to = $this->input->get('to');
		
		$sql = "
		select g.guest_name, g.related_with, g.invit_type, s.from_hours, s.to_hours
		from guests g 
		left join evt_session s 
			on g.evt_sess_id = s.evt_session_id
		where g.guest_id = ?";

		$guest_name = 'Tamu';
		$invit_type = 'Livestream';
		$from_hours = '10:00';
		$to_hours = '14:00';
		$guest = $this->model->select_raw($sql, [$to]);
		
		if ($guest != null && count($guest) > 0) {
			$guest_name = $guest[0]->guest_name;
			$invit_type = strtolower($guest[0]->invit_type);

			if ($guest[0]->from_hours != null)
				$from_hours = $guest[0]->from_hours;
			if ($guest[0]->to_hours != null)
				$to_hours = $guest[0]->to_hours;
		}

		$data['guest_name'] = $guest_name;
		$data['invit_type'] = $invit_type;
		$data['from_hours'] = $from_hours;
		$data['to_hours'] = $to_hours;

		$this->load->view('home', $data);
	}

	public function testimonial()
	{
		try {
			$data = [
				'guest_name' => $this->input->post('name'),
				'attend_status' => $this->input->post('attendance'),
				'testimoni' => $this->input->post('testi'),
			];
	
			$this->model->insert('testimonial', $data);
	
			$resp = [
				"success" => true,
				"data" => $data
			];
	
			die(json_encode($resp));
		} catch (Exception $e) {
			$resp = [
				"success" => true,
				"data" => [],
				"message" => "Posting failed"
			];
	
			die(json_encode($resp));
		}
	}
}
