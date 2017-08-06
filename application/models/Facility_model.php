<?php

class Facility_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get($id) {
        return null;
    }

    function all() {

        if (get_current_user_locations()) {

            $locations = array(0);
            $location = get_current_user_locations();
            for($i=0; $i<count($location); $i++) {
                $locations[] = (int)$location[$i];
            }

            if ($locations)
                $this->db->where_in('location_id', $locations);
        }
        
        $this->db->order_by('facility_name');

        $query = $this->db->get('facilities');
		
        if ($query->num_rows() > 0)
            return $query->result_array();

        return array();
    }
}