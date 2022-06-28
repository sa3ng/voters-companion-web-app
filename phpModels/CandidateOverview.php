<?php
// class to be utilized by fetchCandidates()
class CandidateOverviewClass
{
    private $name;
    private $candidate_id;
    private $description;
    private $pos_num;
    private $img_url;

    // CONSTRUCTORS
    function __construct($name, $candidate_id, $description, $pos_num, $img_url)
    {
        $this->name = $name;
        $this->candidate_id = $candidate_id;
        $this->description = $description;
        $this->pos_num = $pos_num;
        $this->img_url = $img_url;
    }

    // GETTERS
    function getName()
    {
        return $this->name;
    }

    function getCandidateId()
    {
        return $this->candidate_id;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getPosNum()
    {
        return $this->pos_num;
    }

    function getImgUrl()
    {
        return $this->img_url;
    }
}
