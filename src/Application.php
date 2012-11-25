<?php
class Application {
    public function __construct($scope) {
        $variables = array_merge(
            $_GET,
            $_POST,
            $_SERVER
        );
        
        foreach ($variables as $key=>$value) {
            $scope[$key] = $scope->field($value);
        }
    }

    public function run($scope, $inject, $route, $response) {
        $variables = $route;
        
        foreach ($variables as $key=>$value) {
            $scope[$key] = $scope->field($value);
        }
        
        return $inject(array($response, 'render'));
    }
}
