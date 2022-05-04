<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\NifModel;
use CodeIgniter\RESTful\ResourceController;

class NifController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;

    public function index()
    {
        // 
        if($this->request->getMethod() == 'get') {
            $NifModel = new NifModel();
            $data = $NifModel->findAll();
            return $this->respond($data);
        }
    }
    
    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function afficher_simple_nif($id = null)
    {
        // afficher un nif
        $NifModel = new NifModel();
        $data = $NifModel->find(['num_nif'=> $id]);
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
    public function ajouterNif()
    {
        // ajouter un nif
        $rules = [
            'raisCom' => 'required',
            'nomCom' => 'required',
            'adresse' => 'required',
            'activite' => 'required',
            'capital' => 'required',
            'telephone' => 'required',
            'dateExer' => 'required',
            'debutExer' => 'required',
            'finExer' => 'required',
        ];

        $data = [
            'raisCom' => $this->request->getVar('raisCom'),
            'nomCom' => $this->request->getVar('nomCom'),
            'adresse' => $this->request->getVar('adresse'),
            'activite' => $this->request->getVar('activite'),
            'capital' => $this->request->getVar('capital'),
            'telephone' => $this->request->getVar('telephone'),
            'datExer' => $this->request->getVar('datExer'),
            'debutExer' => $this->request->getVar('debutExer'),
            'finExer' => $this->request->getVar('finExer'),
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

            $NifModel = new NifModel();
            $NifModel->insert($data);

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
    public function modifierNif($id = null)
    {
        // mofifier le nif

        $rules = [
            'raisCom' => 'required',
            'nomCom' => 'required',
            'adresse' => 'required',
            'activite' => 'required',
            'capital' => 'required',
            'telephone' => 'required',
            'dateExer' => 'required',
            'debutExer' => 'required',
            'finExer' => 'required',
        ];

        $data = [
            'raisCom' => $this->request->getVar('raisCom'),
            'nomCom' => $this->request->getVar('nomCom'),
            'adresse' => $this->request->getVar('adresse'),
            'activite' => $this->request->getVar('activite'),
            'capital' => $this->request->getVar('capital'),
            'telephone' => $this->request->getVar('telephone'),
            'datExer' => $this->request->getVar('datExer'),
            'debutExer' => $this->request->getVar('debutExer'),
            'finExer' => $this->request->getVar('finExer'),
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
            $NifModel = new NifModel();
            $NifModel->where([
                "num_nif"=> $id
            ])->set($data)->update();
            
            $response = [
                'status'=> 201,
                'error'=> null,
                'messages'=> [
                    'success'=> "modifier avec succes !"
                ]
            ];
            return $this->respond($response);
        }
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
    public function supprimerNif($id = null)
    {
        // supprimer un nif
        $model = new NifModel();
        $data = $model->find(['num_nif'=> $id]);
        if(!$data) {
            return $this->FailNotFound("donnee introuvable");
        } else {
            $model->delete($id);

            $response = [
                'status'=> 200,
                'error'=> null,
                'messages'=> [
                    'success'=> "supprimee avec succes"
                ]
            ];
            
            return $this->respond($response);
        }      
    }
}
