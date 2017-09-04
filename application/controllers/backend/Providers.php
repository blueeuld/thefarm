<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Providers extends TF_Controller {


    public function index()
    {
        $search = \TheFarm\Models\ContactQuery::create();
        $search = $search->useUserQuery()->useGroupQuery()->filterByIncludeInProviderList('y')->endUse()->endUse();

        $search = $search->filterByIsActive(true);

        $contacts = $search->find();
        $contactsArr = [];
        foreach ($contacts as $key => $contact) {
            $contactsArr[$key] = $contact->toArray();
            $contactsArr[$key]['User'] = $contact->getUser()->toArray();
            $contactsArr[$key]['User']['Group'] = $contact->getUser()->getGroup()->toArray();
        }

        $data['contacts'] = $contactsArr;


        $this->load->view('admin/users', $data);
    }

    public function schedule($contact_id = null) {

        $week = $this->uri->segment(5);
        if (!$week) $week = date('Y-m-d');

        $userApi = new UserApi();
        $providers = $userApi->get_users(true, $_SESSION['User']['LocationId']);

        $data['providers'] = $providers;

        $data['contact_id'] = $contact_id;

        $data['week'] = $week;

        $query = $this->db->get_where('users', 'contact_id='.(int)$contact_id);

        $result = $query->row_array();

        if ($contact_id) {
            $currentUser = $userApi->get_user($contact_id);

            $workPlanArr = [];
            foreach ($currentUser['ProviderSchedules'] as $workPlan) {
                $workPlanArr[date('Y-m-d', strtotime($workPlan['StartDate']))][] = date('H:i', strtotime($workPlan['StartDate']));
            }

            $params['date'] = $week;
            $params['base'] = 'backend/providers/update_schedule/'.$contact_id;
            $params['schedule'] = $workPlanArr;
            $params['schedule_code'] = $result['work_plan_code'] ? unserialize($result['work_plan_code']) : false;

            $this->load->library('weeklycalendar', $params);
        }

        $this->load->view('admin/providers/schedule', $data);
    }
    
    public function order() {
        $data['contacts'] = get_provider_list(false, false, false, $_SESSION['User']['LocationId']);
        $this->load->view('admin/providers/order', $data);
    }
    
    public function update() {
	    
	    foreach ($_POST['order'] as $idx => $contact_id) {
			$this->db->update('users', array('order' => $idx), 'contact_id='.$contact_id);
	    }
	    
	    redirect('backend/providers');
    }

    private function remove_date_in_schedule($schedules, $userWorkPlanTimes) {
        foreach ($schedules as $date => $times) {
            if (!$times) {
                foreach ($userWorkPlanTimes as $key => $row) {
                    $start = explode("T", $row['StartDate'])[0];
                    if ($start === $date) {
                        $userWorkPlanTimes[$key]['IsWorking'] = false;
                    }
                }
            }
        }
        return $userWorkPlanTimes;
    }

    public function update_schedule($contact_id = null) {
        $contact_id = (int)$this->input->get_post('contact_id');
        $userApi = new UserApi();
        $user = $userApi->get_user($contact_id);

        $schedule = array();
        $schedule_code = array();
        foreach ($_POST['schedule_day'] as $date => $code)
        {
            $schedule[$date] = isset($_POST['schedule'][$date]) ? $_POST['schedule'][$date] : array();

            if ($code !== '') {
                if (in_array($code, explode(',', '1,2,3,4,5,6,7,8,9,10,A,B,C,D'))) {
                    if (isset($_POST['schedule'][$date])) {
                        $schedule[$date] = $_POST['schedule'][$date];
                    }
                }
                $schedule_code[$date] = $code;
            }
        }

        $scheduleData = $this->remove_date_in_schedule($schedule, $user['ProviderSchedules']);
        var_dump($user['UserWorkPlanTimes']);
        foreach ($schedule as $dt => $tm) {
            foreach ($tm as $item) {
                $endDateTime = new DateTime($dt . ' ' . $item);
                $endDateTime->add(new DateInterval('PT29M'));

                $scheduleData[] = [
                    'ContactId' => (int)$contact_id,
                    'StartDate' => $dt . ' ' . $item,
                    'EndDate' => $endDateTime->format('Y-m-d H:i'),
                    'IsWorking' => true,
                    'WorkPlanCd' => $schedule_code[$dt]
                ];
            }
        }


        $week = $this->input->get_post('week');


        $user['UserWorkPlanTimes'] = $scheduleData;

        $savedUser = $userApi->save_user($user);
//
//
//        foreach ($schedule_code as $date => $code) {
//            $this->_insert_or_update_date($contact_id, $date, $code);
//        }
//
//        foreach ($schedule as $date => $times) {
//            $this->db->delete('user_work_plan_time', 'contact_id='.$contact_id.' AND start_date BETWEEN \''.$date.' 00:00:00\' AND \''.$date.' 23:59:59\'');
//            foreach ($times as $time) {
//                $this->_insert_or_update_time($contact_id, $date . ' ' . $time . ':00');
//            }
//        }
//
//
//        $this->db->update('users', array(
//            'work_plan' => serialize($schedule),
//            'work_plan_code' => serialize($schedule_code)
//        ), array('contact_id' => $contact_id));

        redirect('backend/providers/schedule/'.$contact_id.'/'.$week);
    }
}
