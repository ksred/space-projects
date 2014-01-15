<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Model_projects');
		$this->load->model('Model_tasks');
	}

	public function index() {
		$data['title'] = "Space: Projects";
		$projects = $this->Model_projects->fetch()->result();
		foreach ($projects as $p) {
			$tasks = $this->Model_tasks->fetch_all_by_project($p->id)->result();
			if (count($tasks) > 0) {
				$done = 0;
				foreach ($tasks as $t) {
					if ($t->status == 1) $done++;
				}
				$p->total = count($tasks);
				$p->done = $done;
				$p->perc = round(($p->done/$p->total) * 100);
			} else {
				$p->total = 0;
				$p->done = 0;
				$p->perc = 0;
			}
		}
		$data['projects'] = $projects;
		$this->load->view('projects/list', $data);
	}

	public function add() {
		$data['title'] = "Space: add new project";
		$this->load->view('projects/add', $data);
	}

	public function add_post() {
		$data['title'] = $this->input->post('project-title');
		$data['desc'] = $this->input->post('project-desc');
		if (($data['title'] === false) && ($data['desc'] === false)) {
			$this->session->set_flashdata('error', 'Title and desc cannot be blank');
			header('Location: '.BASE_URL.'projects/add');
		}
		$res = $this->Model_projects->add($data);
		if ($res > 0) {
			$this->session->set_flashdata('success', 'Project added successfully');
			header('Location: '.BASE_URL.'projects');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong when saving');
			header('Location: '.BASE_URL.'projects/added');
		}//end if success
	}

	public function view($id) {
		$project = $this->Model_projects->fetch_one($id)->result();
		if (count($project) < 1) {
			$this->session->set_flashdata('error', 'That project doesn\'t exist');
			header('Location: '.BASE_URL.'projects');
		} else {
			$p = $project[0];
			$tasks = $this->Model_tasks->fetch_all_by_project($id)->result();
			if (count($tasks) > 0) {
				$done = 0;
				foreach ($tasks as $t) {
					if ($t->status == 1) $done++;
				}
				$p->total = count($tasks);
				$p->done = $done;
				$p->perc = round(($p->done/$p->total) * 100);
			} else {
				$p->total = 0;
				$p->done = 0;
				$p->perc = 0;
			}
			$data['project'] = $p;
			$data['tasks'] = $tasks;
			$data['title'] = 'Space: '.$project[0]->title;
			$this->load->view('projects/view', $data);
		}
	}

	public function get_progress() {
		$id = $this->input->post('project');
		$tasks = $this->Model_tasks->fetch_all_by_project($id)->result();
		if (count($tasks) > 0) {
			$done = 0;
			foreach ($tasks as $t) {
				if ($t->status == 1) $done++;
			}
			$data['progress'] = 1;
			$data['total'] = count($tasks);
			$data['done'] = $done;
			$data['perc'] = round(($data['done']/$data['total']) * 100);
		} else {
			$data['total'] = 0;
			$data['done'] = 0;
			$data['perc'] = 0;
			$data['progress'] = 0;
		}
		echo json_encode($data);
		
	}
}

/* End of file landing.php */
/* Location: ./application/controllers/landing.php */
