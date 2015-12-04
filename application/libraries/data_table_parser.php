<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * datatable后台参数分析和数据请求类
 * **********暂时不支持数据库表名有点的情况*********
 * @author huweisong
 *
 */
class Data_table_parser {

//	public static $instance;
    /**
     * CI的db类，数据库类
     * @var unknown_type
     */
    var $db;

    /**
     * 查询的列
     * 参考http://codeigniter.org.cn/user_guide/database/active_record.html#select
     * $this->db->select();
     * CI中的说明该字段是用逗号分割的字符串，实际代码中发现这个是可以用数组的（方便datatable的显示）
     * 字段可以有'NOW() AS `Day`'这样的复杂类型，如果是这样的话$colsFormat就必须是FALSE
     * @var array
     */
    var $cols;

    /**
     * 查询列格式化，默认是NULL，如果你把它设为FALSE， CodeIgniter 将不会使用反引号保护你的字段或者表名 。这在进行复合查询时很有用。
     * 参考http://codeigniter.org.cn/user_guide/database/active_record.html#select
     * $this->db->select();
     * @var bool
     */
    var $colsFormat;

    /**
     * 需要排序的列
     * 这些列会被拼接到order by里面
     * 这里注意，如果查询的列和排序的列一样，那么一定不能有AS这样的复杂类型
     * @var array
     */
    var $sort_cols;

    /**
     * 需要筛选的列
     * 这些列会被拼接到where里面，通用的都是like，至于其他的条件查询见获取数据的时候的where条件
     * @var array
     */
    var $filter_cols;

    /**
     * 数据表，这是一个主表，用于连接其他表使用
     * 如果是单表的话，就不需要下面的join了
     * @var string
     */
    var $table;

    /**
     * 需要连接的表组成的数组
     * @var array
     */
    var $join;

    /**
     * 查询开始位置，即学名偏移量
     * @var int
     */
    var $start;

    /**
     * 限制查询所返回的结果数量
     * @var int
     */
    var $length;

    /**
     * 构造方法
     */
    function Data_table_parser() {
        $this->clear();
        $this->start = 0;
        $this->length = 10;
    }

    /**
     * 设置数据库的DB
     * CI的db类作为参数
     * @param class $db
     */
    public function set_db($db) {
        $this->db = $db;
    }

    /**
     * 清除查询、过滤条件
     * 清除表，连接表
     */
    public function clear() {
        $this->cols = array();
        $this->sort_cols = array();
        $this->filter_cols = array();
        $this->colsFormat = NULL;
        $this->table = '';
        $this->join = array();
    }

    /**
     * Datatable的参数初始化到db的查询条件中
     * databales的解析参考 http://datatables.net/examples/data_sources/server_side.html
     */
    function initialize($init_sort=true) {
        //databales的解析参考 http://datatables.net/examples/data_sources/server_side.html
        if (isset($_REQUEST['iDisplayStart']) && $_REQUEST['iDisplayLength'] != '-1') {
            $this->start = intval($_REQUEST['iDisplayStart']);
            $this->length = intval($_REQUEST['iDisplayLength']);
        }

        //Sort
        if($init_sort){
            if (isset($_REQUEST['iSortCol_0'])) {
                for ($i = 0; $i < intval($_REQUEST['iSortingCols']); $i++) {
                    if ($_REQUEST['bSortable_' . intval($_REQUEST['iSortCol_' . $i])] == "true") {
                        $this->db->order_by($this->sort_cols[intval($_REQUEST['iSortCol_' . $i])], ($_REQUEST['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc'));
                    }
                }
            }
        }

        //where
        if (isset($_REQUEST['sSearch'])) {
            for ($i = 0; $i < intval($_REQUEST['iColumns']); $i++) {
                if ($_REQUEST['sSearch_' . $i] !== '') {
                    $this->db->like($this->filter_cols[$i], $_REQUEST['sSearch_' . $i]);
                }
            }
        }
    }

    /**
     * 查询的主表	 
     * 参考CI的$this->db->from();
     * @param string $table
     */
    public function from($table) {
        $this->table = $table;
    }

    /**
     * 连表
     * 如果你想要在查询中使用多个连接，可以多次调用本函数。
     * 如果你需要指定 JOIN 的类型，你可以通过本函数的第三个参数来指定。可选项包括：left, right, outer, inner, left outer, 以及 right outer.
     * 参考CI的$this->db->join();
     * @param string $table
     * @param string $where
     * @param string $type=''
     */
    public function join($table, $where, $type = '') {
        $this->join[] = array('table' => $table, 'where' => $where, 'type' => $type);
    }

    /**
     * 查询的列，第一个参数，列的数组
     * 排序和筛选默认都是一样的
     * 可接受一个可选的第二个参数。如果你把它设为FALSE， CodeIgniter 将不会使用反引号保护你的字段或者表名 。这在进行复合查询时很有用
     * 如果第二个参数是FALSE，那么传入的其他表、字段等都使用``分割
     * @param array $cols
     * @param bool $colsFormat
     */
    public function select_cols($cols, $colsFormat = NULL) {
        $this->cols = $cols;
        $this->sort_cols = $cols;
        $this->filter_cols = $cols;
        $this->colsFormat = $colsFormat;
    }

    /**
     * 查询的列，第一个参数，列的数组
     * 排序和筛选的列，第二个参数，两个一样
     * 可接受一个可选的第三个参数。如果你把它设为FALSE， CodeIgniter 将不会使用反引号保护你的字段或者表名 。这在进行复合查询时很有用
     * 如果第三个参数是FALSE，那么传入的其他表、字段等都使用``分割
     * @param arry $cols
     * @param array $sort_filter_cols
     * @param bool $colsFormat
     */
    public function select_cols_sort_filter($cols, $sort_filter_cols, $colsFormat = NULL) {
        $this->cols = $cols;
        $this->sort_cols = $sort_filter_cols;
        $this->filter_cols = $sort_filter_cols;
        $this->colsFormat = $colsFormat;
    }

    /**
     * 查询的列，第一个参数，列的数组
     * 排序的列，第二个参数
     * 筛选的列，第三个参数
     * 可接受一个可选的第四个参数。如果你把它设为FALSE， CodeIgniter 将不会使用反引号保护你的字段或者表名 。这在进行复合查询时很有用
     * 如果第四个参数是FALSE，那么传入的其他表、字段等都使用``分割
     * Enter description here ...
     * @param array $cols
     * @param array $sort_cols
     * @param array $filter_cols
     * @param bool $colsFormat
     */
    public function select($cols, $sort_cols, $filter_cols, $colsFormat = NULL) {
        $this->cols = $cols;
        $this->sort_cols = $sort_cols;
        $this->filter_cols = $filter_cols;
        $this->colsFormat = $colsFormat;
    }

    /**
     * 获取记录总条数，执行完不清空条件
     * 第一个参数，条件数组，这里传入一些其他的条件，例如，区间筛选（时间和数字大小）、等于条件等
     * 参考$this->db->where();第三个关联数组方法:
     * @param array $cwhere
     */
    public function count($cwhere = NULL) {
        $this->db->from($this->table);
        foreach ($this->join as $ajoin) {
            $this->db->join($ajoin['table'], $ajoin['where'], $ajoin['type']);
        }
        if ($cwhere) {
            $this->db->where($cwhere);
        }
        $this->initialize(false);
        return $this->db->count_all_results();
    }

    /**
     * 获取记录含有group_by分组查询的总条数，执行完不清空条件
     * 第一个 分组字段
     * 第二个参数，条件数组，这里传入一些其他的条件，例如，区间筛选（时间和数字大小）、等于条件等
     * 参考$this->db->where();第三个关联数组方法:
     * @param array $group
     * @param array $cwhere
     */
    public function count_group($group = array(), $cwhere = NULL) {
        $this->db->select($this->cols, $this->colsFormat);
        $this->db->from($this->table);
        foreach ($this->join as $ajoin) {
            $this->db->join($ajoin['table'], $ajoin['where'], $ajoin['type']);
        }
        if ($cwhere) {
            $this->db->where($cwhere);
        }
        $this->initialize(false);
        $this->db->group_by($group);
        return count($this->db->get()->result());
    }

    /**
     * 获取查询条件含有group_by和where_in条件查询的总条数，执行完不清空条件
     * 第一个参数，条件数组$cwhere，这里传入一些其他的条件，例如，区间筛选（时间和数字大小）、等于条件等
     * 第二个 $where_in 条件
     * 第三个$group: 分组条件
     * 参考$this->db->where();
     * @param array $group
     * @param array $cwhere
     */
    public function count_group_where_in($cwhere = NULL, $where_in = NULL, $group = array()) {
        $this->db->select($this->cols, $this->colsFormat);
        $this->db->from($this->table);
        foreach ($this->join as $ajoin) {
            $this->db->join($ajoin['table'], $ajoin['where'], $ajoin['type']);
        }
        if ($cwhere) {
            $this->db->where($cwhere);
        }
        if ($where_in) {
            $this->db->where_in($where_in['column'], $where_in['$arr']);
        }
        $this->initialize(false);
        $this->db->group_by($group);
        return count($this->db->get()->result());
    }

    /**
     * 获取分页数据，执行完清空条件
     * 第一个参数，条件数组，这里传入一些其他的条件，例如，区间筛选（时间和数字大小）、等于条件等
     * 参考$this->db->where();第三个关联数组方法:
     * @param array $cwhere
     */
    public function get($cwhere = NULL) {
        $this->db->select($this->cols, $this->colsFormat);
        $this->db->from($this->table);
        foreach ($this->join as $ajoin) {
            $this->db->join($ajoin['table'], $ajoin['where'], $ajoin['type']);
        }
        if ($cwhere) {
            $this->db->where($cwhere);
        }
        $this->initialize();
        $this->clear();
        return $this->db->limit($this->length, $this->start)->get();
    }

    /**
     * 获取分页数据，执行完清空条件
     * 第一个 分组字段
     * 第二个参数，条件数组，这里传入一些其他的条件，例如，区间筛选（时间和数字大小）、等于条件等
     * 参考$this->db->where();第三个关联数组方法:
     * @param array $group
     * @param array $cwhere
     */
    public function get_group($group = array(), $cwhere = NULL) {
        $this->db->select($this->cols, $this->colsFormat);
        $this->db->from($this->table);
        foreach ($this->join as $ajoin) {
            $this->db->join($ajoin['table'], $ajoin['where'], $ajoin['type']);
        }
        if ($cwhere) {
            $this->db->where($cwhere);
        }
        $this->initialize();
        $this->db->group_by($group);
        $this->clear();
        return $this->db->limit($this->length, $this->start)->get();
    }

    /**
     * 获取全部数据，执行完清空条件
     * 第一个 分组字段
     * 第二个参数，条件数组，这里传入一些其他的条件，例如，区间筛选（时间和数字大小）、等于条件等
     * 参考$this->db->where();第三个关联数组方法:
     * @param array $group
     * @param array $cwhere
     */
    public function get_group_all($group = array(), $cwhere = NULL) {
        $this->db->select($this->cols, $this->colsFormat);
        $this->db->from($this->table);
        foreach ($this->join as $ajoin) {
            $this->db->join($ajoin['table'], $ajoin['where'], $ajoin['type']);
        }
        if ($cwhere) {
            $this->db->where($cwhere);
        }
        $this->initialize();
        $this->db->group_by($group);
        $this->clear();
        return $this->db->get();
    }

    /**
     * 获取所有数据，执行完清空条件
     * 第一个参数，条件数组，这里传入一些其他的条件，例如，区间筛选（时间和数字大小）、等于条件等
     * 参考$this->db->where();第三个关联数组方法:
     * @param array $cwhere
     */
    public function get_all($cwhere = NULL) {
        $this->db->select($this->cols, $this->colsFormat);
        $this->db->from($this->table);
        foreach ($this->join as $ajoin) {
            $this->db->join($ajoin['table'], $ajoin['where'], $ajoin['type']);
        }
        if ($cwhere) {
            $this->db->where($cwhere);
        }
        $this->initialize();
        $this->clear();
        return $this->db->get();
    }

    /**
     * where_in查询
     * @param string $column
     * @param array $values
     */
    public function where_in($column, $values = array()) {
        $this->db->where_in($column, $values);
    }

    /**
     * 获取带where_in条件的数据,并分组
     * @param array $cwhere
     * @param array $where_in
     */
    public function get_group_where_in($cwhere = NULL, $where_in = NULL, $group = NULL) {
        $this->db->select($this->cols, $this->colsFormat);
        $this->db->from($this->table);
        foreach ($this->join as $ajoin) {
            $this->db->join($ajoin['table'], $ajoin['where'], $ajoin['type']);
        }
        if ($cwhere) {
            $this->db->where($cwhere);
        }
        if ($where_in) {
            $this->db->where_in($where_in['column'], $where_in['$arr']);
        }
        $this->initialize();
        $this->db->group_by($group);
        $this->clear();
        return $this->db->get();
    }

    /**
     * 执行一个sql语句
     * @param string $sql
     */
    public function query($sql) {
        $this->initialize();
        return $this->db->query($sql);
    }

    /**
     * 获取$sql查询中结果的总条数
     * @param unknown_type $sql
     * @return number
     */
    public function count_query($sql) {
        $res = $this->db->query($sql)->result();
        if (empty($res))
            return 0;
        return count($res);
    }

}

?>