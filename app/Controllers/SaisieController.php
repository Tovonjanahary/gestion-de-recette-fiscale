<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\SaisieModel;
use CodeIgniter\RESTful\ResourceController;

class SaisieController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function faireSaisie()
    {
        // faire du saisie

        $rules = [
            'date' => 'required',
            'num_impot' => 'required',
            'num_nif' => 'required',
            'chiffreAff' => 'required',
            'montPay' => 'required',
            'montVers' => 'required',
            'reste' => 'required',
            'modeP' => 'required',
            'banque' => 'required',
            'bordereau' => 'required',
        ];

        $data = [
            'date' => $this->request->getVar('date'),
            'num_impot' => $this->request->getVar('num_impot'),
            'num_nif' => $this->request->getVar('num_nif'),
            'chiffreAff' => $this->request->getVar('chiffreAff'),
            'montPay' => $this->request->getVar('montPay'),
            'montVers' => $this->request->getVar('montVers'),
            'reste' => $this->request->getVar('reste'),
            'modeP' => $this->request->getVar('modeP'),
            'banque' => $this->request->getVar('banque'),
            'bordereau' => $this->request->getVar('bordereau'),
        ];

        $validation = \Config\Services::validation();

        if(!$this->validate($rules)) {
            $response = [
                'status'=> 400,
                'message'=> [
                    'error'=> "les champs du formulaire sont obligatoires",
                ],
            ];
            return $this->respond($response);
        } else {
            $saisieModel = new SaisieModel();
            $saisieModel->insert($data);
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     * 
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
