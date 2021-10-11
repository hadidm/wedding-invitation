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
		$this->load->view('home');
	}

	public function testimonial()
	{
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
	}
}
