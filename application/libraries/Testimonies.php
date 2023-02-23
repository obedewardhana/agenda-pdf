<?php
class Testimonies {
    protected $ci;
    private $get_testimonial;

    function __construct() {
        $this->ci =& get_instance();

        $this->get_testimonial = $this->ci->db->get("testimonials")->result();
    }
    function get_testimonial() {
        return $this->get_testimonial;
    }
    function get_testimonial_name() {
        return $this->get_testimonial->name;
    }
    function get_testimonial_photo() {
        return $this->get_testimonial->photo;
    }
    function get_testimonial_description() {
        return $this->get_testimonial->description;
    }
}