<?php
class Teachers extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("TeacherModel");
    }


    public function index()
    {
        $this->load->view("teachers_table");
    }



    public function get_teachers()
    {
        $this->load->model("TeacherModel");
        $data["teachers"] = $this->TeacherModel->get_all_teachers();
        $this->load->view("teachers_table", $data);
    }


    public function get_all_teachers()
    {
        $this->load->model("TeacherModel");
        $data['teachers'] = $this->TeacherModel->get_all_teachers();
        echo json_encode($data);
    }


    public function create()
    {
        $teacherData = array(
            'name' => $this->input->post('name', true),
            'gender' => $this->input->post('gender', true),
            'dob' => $this->input->post('dob', true),
            'phone_number' => $this->input->post('phone_number', true)
        );

        $inserted = $this->TeacherModel->create_teacher($teacherData);

        if ($inserted) {
            echo json_encode(array('status' => 'success', 'message' => 'Teacher added successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to add teacher.'));
        }
    }


    public function update($id)
    {
        $teacherData = array(
            'name' => $this->input->post('name', true),
            'gender' => $this->input->post('gender', true),
            'dob' => $this->input->post('dob', true),
            'phone_number' => $this->input->post('phone_number', true)
        );

        if ($this->TeacherModel->update_teacher($id, $teacherData)) {
            echo json_encode(array('status' => 'success', 'message' => 'Teacher updated successfully.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update teacher.'));
        }
    }



    public function delete()
{
    $id = $this->input->post('id', true); // Get ID from POST request

    if (!$id) {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid ID'));
        return;
    }

    $deleted = $this->TeacherModel->delete_teacher($id);

    if ($deleted) {
        echo json_encode(array('status' => 'success', 'message' => 'Teacher deleted successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to delete teacher.'));
    }
}


}
?>