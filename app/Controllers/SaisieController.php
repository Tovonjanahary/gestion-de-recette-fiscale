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
    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function afficherSaisie()
    {
        //
        if($this->request->getMethod() == 'get') {
            $model = new SaisieModel();
            $data = $model->findAll();
            return $this->respond($data);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function afficherUnSaisie($id = null)
    {
        //raw query
        $query = "SELECT impot.code_recepice, impot.num_impot, impot.périodicité, nif.num_nif, nif.raisCom, nif.nomCom, nif.adresse, saisie.date, saisie.chiffreAff, saisie.montPay, saisie.montVers, saisie.reste, saisie.modeP, saisie.bordereau, saisie.banque FROM saisie INNER JOIN impot ON impot.num_impot=saisie.num_impot INNER JOIN nif ON nif.num_nif=saisie.num_nif where id_saisie='$id'";
        $data = $this->db->query($query)->getResult('array');
        return $this->respond($data);
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
                'messages'=> [
                    'error'=> "les champs du formulaire sont obligatoires",
                ],
            ];
            return $this->respond($response);
        } else {
            $saisieModel = new SaisieModel();
            $hr = $saisieModel->insert($data);
            $result = $saisieModel->find(['id_saisie'=>$hr]);

            $response = [
                'status'=> 201,
                'error'=> null,
                'messages'=> [
                    'success'=> "enregistrer avec succes !"
                ],
                'data' => $result[0]
            ];

            return $this->respondCreated($response);
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
