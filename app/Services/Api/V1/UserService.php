<?php

namespace App\Services\Api\V1;

use App\Repositories\Api\V1\MeasureTypeRepository;
use App\Repositories\Api\V1\MeasureMaleRepository;
use App\Repositories\Api\V1\MeasureFemaleRepository;
use App\Repositories\Api\V1\UserRepository;
use App\Repositories\Api\V1\SubCategoryRepository;
use App\Repositories\Api\V1\BrandRepository;
use App\Repositories\Api\V1\ModelRepository;
use App\Repositories\Api\V1\ColorRepository;
use App\Models\MeasureMale;

class UserService
{

    private $measureTypeRepository;

    private $measureMaleRepository;

    private $measureFemaleRepository;

    private $userRepository;

    private $subCategoryRepository;

    private $brandRepository;

    private $modelRepository;

    private $colorRepository;
    /**
     * AuthController constructor.
     *
     * @param UserRepository $userRepository UserRepository
     */
    public function __construct(
        MeasureTypeRepository $measureTypeRepository,
        MeasureMaleRepository $measureMaleRepository,
        MeasureFemaleRepository $measureFemaleRepository,
        UserRepository $userRepository,
        SubCategoryRepository $subCategoryRepository,
        BrandRepository $brandRepository,
        ModelRepository $modelRepository,
        ColorRepository $colorRepository
    )
    {
        $this->measureTypeRepository = $measureTypeRepository;
        $this->measureMaleRepository = $measureMaleRepository;
        $this->measureFemaleRepository = $measureFemaleRepository;
        $this->userRepository = $userRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->brandRepository = $brandRepository;
        $this->modelRepository = $modelRepository;
        $this->colorRepository = $colorRepository;
    }


    public function findMeasureTypeByGender($gender)
    {
        $mesureTypes = $this->measureTypeRepository->findWhere(['gender_id'=> $gender]);
        return $mesureTypes;
    }

    public function createMeasure($request)
    {
        $data = $request->all();
        $user = $this->userRepository->first();
        $data['measure_unit_id'] = 1;
        $data['user_id'] = $user->id;
        if ((int)$request->get('gender') == MeasureMale::TYPE) {
            return $this->measureMaleRepository->create($data);
        }
        return $this->measureFemaleRepository->create($data);
    }

    public function subcategories()
    {
        return $this->subCategoryRepository->all();
    }

    public function getBrands()
    {
        return $this->brandRepository->all();
    }

    public function getModels()
    {
        return $this->modelRepository->all();
    }

    public function getColors()
    {
        return $this->colorRepository->all();
    }
}