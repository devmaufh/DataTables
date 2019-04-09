<?php
class Cursos_model  
{
    private $id;
    private $name;
    private $description;
    private $cost;
    public function __construct($name,$description,$cost) {
        $this->name=$name;
        $this->description=$description;
        $this->cost=$cost;
    }
    public function set_id($id)
    {
        $this->id=$id   ;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function set_name($name)
    {
        $this->name=$name;
    }
    public function get_name()
    {
        return $this->name;
    }
    public function set_description($description)
    {
        $this->description=$description;
    }
    public function get_description()
    {
        return $this->description;
    }
    public function set_cost($cost)
    {
        $this->cost=$cost;
    }
    public function get_cost()
    {
        return $this->cost;
    }
}
?>