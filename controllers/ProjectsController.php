<?php

require_once 'AppController.php';

class ProjectsController extends AppController{
    public function projects($id = null) {

        if($id) {
            return $this->render('project', ['id' => $id]);
        }

        $projects = [
            'WDPAI', 'WDSI', "IO"
        ];

        return $this->render('projects', ['projects' => $projects]);

    }
}