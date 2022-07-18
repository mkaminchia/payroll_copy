<?php 

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
	public function __construct()
    {
        //parent::__construct();
        //$this->db = \Config\Database::connect();
        $this->db = db_connect();
    }

    public function viewAllRoles()
    {
        //Temporarily define $rolesList
        $rolesList = array();

        //Query
        $query = $this->db->query("
            SELECT role_id, role_name, role_description
            FROM roles
            WHERE is_deleted = 0
            ");

        $i = 0;

        //Store details in array
        foreach ($query->getResult() as $row)
        {
        //Initialize User Info Array
        $rolesList[$i] = array('role_id' => $row->role_id, 'role_name' => $row->role_name, 'role_description' => $row->role_description);
        $i++;
        }

        //Return array
        return $rolesList;
    }

}