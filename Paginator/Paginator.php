<?php

class yapf_Paginator_Paginator
{
    /*
     * must be an instance of yapf_Template
     * @var yapf_Template
     */
    protected $template;

    /**
     * items shown per one page
     * @var int
     */
    protected $perPage;

    /**
     * currently viewed page number
     * @var int
     */
    protected $curPage;

    /**
     * number of items that needs to be paged
     * @var int
     */
    protected $totalItems;

    /**
     * number of pages in the pager
     * @var int
     */
    protected $totalPages;


    /**
     * @param yapf_Template $template
     * @param int $per_page
     * @param int $pageparam
     * @param bool $totalItems
     */

    public function __construct($template, $perPage, $pageParam, $totalItems = false)
    {
        $this->template = $template;
        $this->perPage = $perPage;
        $this->totalItems = $totalItems;

        if (!yapf_Http_Request::get($pageParam) || yapf_Http_Request::getInt($pageParam) < 1) {
            $this->curPage = 1;
        } else {
            $this->curPage = yapf_Http_Request::getInt($pageParam);
        }

        $this->start = ($this->curPage - 1) * $this->perPage;
        if($totalItems){
            $this->totalPages = ceil($this->totalItems / $this->perPage);
        }
    }

    public function hasNextPage()
    {
        if (($this->curPage) * $this->perPage < $this->totalItems) {
            return $this->curPage + 1;
        } else {
            return false;
        }
    }

    public function hasPrevPage()
    {
        if (($this->curPage - 1) * $this->perPage > 0) {
            return $this->curPage - 1;
        } else {
            return false;
        }
    }

    public function render($params = array()){
        $tplVars = array_merge(array(
            'currentPage'   =>  $this->curPage,
            'perPage'       =>  $this->perPage,
            'totalPages'    =>  $this->totalPages
        ), $params);

        return $this->template->render($tplVars);
    }
}