
<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name','email','mobile','user_type','password'];

    public function getUser($slug = false)
    {
        if ($slug === false)
        {
            return $this->findAll();
        }
    }
    
    function create($formArray){
        $this->db->insert('users',$formArray);  // Insert into useres(name,email);

    }

    function all(){
       return  $this->db->get('users')->result_array(); // Select * from useres
    }

    function getUser($userId){
        $this->db->where('user_id',$userId);
        return $this->db->get('users')->row_array(); // select *form users where userid=?
    }

    function updateUser($userId,$formArray){
        $this->db->where('user_id',$userId);
        $this->db->update('users',$formArray); // Update users set name =?, email = ?


    }

    function deleteUser($userId){
        $this->db->where('user_id',$userId);
        $this->db->delete('users'); // Delete from users Where user_id = ?
        
        // print_r("Deleted");
    }
    
}
?>