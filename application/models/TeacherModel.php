<?php
class TeacherModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getTeacher($id){
        
    }
    public function get_all_teachers()
    {
        return $this->db->get("teachers")->result();
    }

    public function create_teacher($data)
    {
        return $this->db->insert('teachers', $data);
    }

    // Update teacher by ID
    public function update_teacher($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('teachers', $data);
    }

    // Delete teacher by ID
    public function delete_teacher($id)
    {
        return $this->db->delete('teachers', array('id' => $id));
    }

}
?>