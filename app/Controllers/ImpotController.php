<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ImpotModel;
use CodeIgniter\RESTful\ResourceController;

class ImpotController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;

    public function index()
    {
        // affichage de l'impot
        if($this->request->getMethod() == 'get') {
            $ImpotModel = new ImpotModel();
            $data = $ImpotModel->findAll();
            return $this->respond($data);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function afficherUnImpot($id = null)
    {
        // afficher un impot
        $ImpotModel = new ImpotModel();
        $data = $ImpotModel->find(['num_impot'=> $id]);
        if(!$data) return $this->FailNotFound("donnee introuvable");
        return $this->respond($data[0]);
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
    public function creerImpot()
    {
        //
        $rules = [
            'code_recepice' => 'required',
            'nom_impot' => 'required',
            'abreviation' => 'required',
            'nom_budget' => 'required',
            'périodicité' => 'required'
        ];

        $data = [
            'code_recepice' => $this->request->getVar('code_recepice'),
            'nom_impot' => $this->request->getVar('nom_impot'),
            'abreviation' => $this->request->getVar('abreviation'),
            'nom_budget' => $this->request->getVar('nom_budget'),
            'périodicité' => $this->request->getVar('périodicité')
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
            $impotModel = new ImpotModel();

            $impotModel->insert($data);

            $response = [
                'status'=> 201,
                'error'=> null,
                'messages'=> [
                    'success'=> "enregistrer avec succes !"
                ]
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
