<?php
namespace SyedOmair\Bundle\AppBundle\Services;

use FOS\RestBundle\Util\Codes;

class BaseService
{
    protected $entityManager;
    protected $errorService;

    public function __construct($entityManager, $errorService)
    {
        $this->entityManager = $entityManager;
        $this->errorService = $errorService;
    }

    protected function successResponse($record)
    {
        return array(
            'status' => Codes::HTTP_OK,
            'data' => $record,
            );
    }

    protected function successResponseList($records, $count, $page, $limit)
    {
        $records = array(
            'offset' => $page,
            'limit' => $limit,
            'count' => $count,
            'records' => $records,
            );
        return $this->successResponse($records);
    }
}
