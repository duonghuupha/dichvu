<?php
class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $date, $days = 1, $color = '', $id, $event) {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color, $id, $event];
        // $event = 1 => co thao tac; $event = 0 => khong co thao tac
    }

    public function __toString() {
        $convert = new Convert();
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= $this->return_Month_to_Vi(date('F', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day))).' ';
        $html .= date('Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $convert->return_day_text($day) . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        if($event[5] == 1){//  cap nhat
                            $html .= '<div class="event' . $event[3] . '" onclick="detail('.$event[4].', 1)">';
                        }elseif($event[5] == 2){ // xoa
                            $html .= '<div class="event' . $event[3] . '" onclick="detail('.$event[4].', 2)">';
                        }elseif($event[5] == 3){ // cap nhat va xoa
                            $html .= '<div class="event' . $event[3] . '" onclick="detail('.$event[4].', 3)">';
                        }else{
                            $html .= '<div class="event' . $event[3] . '">';
                        }
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    function return_Month_to_Vi($text){
        if($text == 'January'){
            $string = "Tháng 1";
        }elseif($text == 'February'){
            $string = 'Tháng 2';
        }elseif($text == 'March'){
            $string = 'Tháng 3';
        }elseif($text == 'April'){
            $string = 'Tháng 4';
        }elseif($text == 'May'){
            $string = 'Tháng 5';
        }elseif($text == 'June'){
            $string = 'Tháng 6';
        }elseif($text == 'July'){
            $string = 'Tháng 7';
        }elseif($text == 'August'){
            $string = 'Tháng 8';
        }elseif($text == 'September'){
            $string = 'Tháng 9';
        }elseif($text == 'October'){
            $string = 'Tháng 10';
        }elseif($text == 'November'){
            $string = 'Tháng 11';
        }elseif($text == 'December'){
            $string = 'Tháng 12';
        }
        return $string;
    }

}
?>
