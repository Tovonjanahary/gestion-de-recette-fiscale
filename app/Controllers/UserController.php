<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
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
    public function signup()
    {
        // enregistrer un compte
        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'telephone' => 'required',
            'CIN' => 'required',
            'poste' => 'required',
            'password' => 'required'
        ];

        $data = [
            'nom' => $this->request->getVar('nom'),
            'prenom' => $this->request->getVar('prenom'),
            'email' => $this->request->getVar('email'),
            'adresse' => $this->request->getVar('adresse'),
            'telephone' => $this->request->getVar('telephone'),
            'CIN' => $this->request->getVar('CIN'),
            'poste' => $this->request->getVar('poste'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];

        $validation = \Config\Services::validation();
        $userModel = new UserModel();

        if(!$this->validate($rules)) {
            $response = [
                'status'=> 400,
                'message'=> [
                    'error'=> "les champs du formulaire sont obligatoires",
                ],
            ];
            return $this->respond($response);
        } else {
            $findEmail = $userModel->where('email', $data['email'])->first();
            if($findEmail) {
                $response = [
                    'status'=> 400,
                    'message'=> [
                        'error'=> "cet email existe deja",
                    ],
                ];
                return $this->respond($response);

            } else {
                $user = $userModel->insert($data);
                
                $response = [
                    'status'=> 201,
                    'error'=> null,
                    'messages'=> [
                        'success'=> " Enregistrer avec success !"
                    ],
                    'data' => $user
                ];
                return $this->respondCreated($response);
            }

        }
    }

    public function signin() {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password')
        ];

        $validation = \Config\Services::validation();
        $userModel = new UserModel();

        if(!$this->validate($rules)) {
            $response = [
                'status'=> 400,
                'message'=> [
                    'error'=> "les champs du formulaire sont obligatoires",
                ],
            ];

            $response = [
                'status'=> 400,
                'message'=> [
                    'error'=> "les champs du formulaire sont obligatoires",
                ],
            ];
            return $this->respond($response);
        } else {
            $findEmail = $userModel->where('email', $data['email'])->first();
            if($findEmail) {
                $password_correct = password_verify($data['password'], $findEmail['password']);

                if(!$password_correct) {
                    $response = [
                        'status'=> 400,
                        'message'=> [
                            'error'=> "mot de passe incorrecte",
                        ],
                    ];
                    return $this->respond($response);

                } else {
                    $response = [
                        'status'=> 200,
                        'error'=> null,
                        'messages'=> [
                            'success'=> " connectee !"
                        ]
                    ];

                    return $this->respond($response);
                }
            }
            // return $this->respond($findEmail['password']);
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
