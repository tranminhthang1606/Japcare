<?php
namespace App\Repositories;

interface RepositoryInterface
{
    public function all($columns = array('*'));

    public function paginate($limit = null, $columns = array('*'));

    public function findById($id, $columns = array('*'));

    public function findByField($field, $value, $columns = array('*'));

    public function findWhere(array $where, $columns = array('*'));

    public function findWhereIn($field, array $values, $columns = array('*'));

    public function findWhereNotIn($field, array $values, $columns = array('*'));

    public function create(array $attributes);

    public function update(array $attributes, $id);

    public function delete($id);

    public function with($relations);

    public function joinFindId($field, $value, $val, $tablejoin, $fieldjoin, $columns = array('*'));
    public function findWhereOrderBy(array $where, $columns = array('*'), $orderWhere, $orderBy);

    public function findWhereFirst(array $where, $columns = array('*'));

    public function findWhereLimit(array $where, $limit = null, $columns = array('*'));

    public function whereLimit(array $where, $orderField, $orderType, $limit = null, $columns = array('*'));

    public function findWhereOrderByLimit(array $where, $columns = array('*'), $orderWhere, $orderBy, $limit);
    
    public function paginateWhereLikeOrderBy(array $where, array $whereLike, $order_by = 'updated_at', $order = 'DESC', $current_page = null, $limit = null, $columns = array('*'));

    public function countData($columns = array('*'));
    public function countWhere(array $where, $columns = array('*'));
//    public function hidden(array $fields);

//    public function visible(array $fields);

//    public function scopeQuery(\Closure $scope);

//    public function getFieldsSearchable();

//    public function setPresenter($presenter);

//    public function skipPresenter($status = true);
}
