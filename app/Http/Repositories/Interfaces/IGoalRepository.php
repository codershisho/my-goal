<?php
namespace App\Http\Repositories\Interfaces;

Interface IGoalRepository{
    public function index($termId);
    public function update($request, $termId);
}