<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Model_projects');
		$this->load->model('Model_tasks');
	}

	public function index() {
		$data['title'] = "Space: Tasks";
		$data['projects'] = $this->Model_projects->fetch()->result();
		$this->load->view('projects/list', $data);
	}

	public function add($id) {
		$project = $this->Model_projects->fetch_one($id)->result();
		$data['title'] = "Space: Add task to ".$project[0]->title;
		$data['project'] = $project[0];
		$this->load->view('tasks/add', $data);
	}

	public function add_post() {
		$tasks = $this->input->post('task');
		$data['project_id'] = $this->input->post('project-id');
		if (!($tasks === false)) {
			foreach ($tasks as $t)  {
				if (!($t == "")) {
					$data['desc'] = $t;
					$res = $this->Model_tasks->add($data);
				}
			}
			if ($res > 0) {
				$this->session->set_flashdata('success', 'Tasks added successfully');
				header('Location: '.BASE_URL.'projects/view/'.$data['project_id']);
			} else {
				$this->session->set_flashdata('error', 'Something went wrong when saving');
				header('Location: '.BASE_URL.'projects/view/'.$data['project_id']);
			}//end if success
		}//end if set
	}

	public function view($id) {
		$project = $this->Model_projects->fetch_one($id)->result();
		if (count($project) < 1) {
			$this->session->set_flashdata('error', 'That project doesn\'t exist');
			header('Location: '.BASE_URL.'projects');
		} else {
			$data['tasks'] = $this->Model_tasks->fetch_all_by_project($id)->result();
			$data['project'] = $project[0];
			$data['title'] = 'Space: '.$project[0]->title;
			$this->load->view('projects/view', $data);
		}
	}

	public function change_status () {
		/*
			In the real world memcache would be in place here, and when this task is changed it would update memcache store
			This keeps memcache fresh and the db never has to get hit to get task updates
		*/
		$id = $this->input->post('task');
		$status = $this->input->post('status');
		$res = $this->Model_tasks->update_task($id, $status);
		echo json_encode(1);
	}

	public function get_status () {
		/*
			Here there is a lot of room for improvement and optimisation, this is for illustraion.
			I would do the following for immediate improvement:
				* Pass array of task/ids from front end
				* Check these against memcache store of task/ids for current task only
				* If there is a change, pass back _only_ the changed task
				* Front end updates changed task, leaves the rest
		*/
		$project = $this->input->post('project');
		//Use memcache in future
		$tasks = $this->Model_tasks->fetch_all_by_project($project)->result();
		if (count($tasks) > 0) {
			//Set changed to true so that we catch updates
			$data['changed'] = 1;
			$data['tasks'] = $tasks;
		} else {
			$data['changed'] = 0;
		}
		echo json_encode($data);
	}
}

/* End of file tasks.php */
/* Location: ./application/controllers/tasks.php */
