<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function index()
	{
		$data['title'] = "Space and productivity";
		$this->load->model('Model_projects');
		$this->load->model('Model_tasks');
		$projects = $this->Model_projects->fetch()->result();
		foreach ($projects as $p) {
			$tasks = $this->Model_tasks->fetch_all_by_project($p->id)->result();
			$done = 0;
			foreach ($tasks as $t) {
				if ($t->status == 1) $done++;
			}
			$p->total = count($tasks);
			$p->done = $done;
			$p->perc = round(($p->done/$p->total) * 100);
		}
		$data['projects'] = $projects;
		$this->load->view('landing', $data);
	}
}

/* End of file landing.php */
/* Location: ./application/controllers/landing.php */
