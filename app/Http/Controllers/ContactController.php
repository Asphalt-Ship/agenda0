<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
    // c'est ce Validator qu'on veut pour gérer le formulaire

class ContactController extends Controller
{
    public function index() {
        // on fait une requête pour récupérer (read) les données de la BDD
        $contacts = Contact::all();
            // équivaut à tout le truc 'prepare("SELECT * FROM contacts")' / 'execute()'

        return view("index", compact("contacts"));
            // on rajoute le compact("contacts") pour injecter les données dans la view
    }

    public function create() {
        return view("create");
    }

    public function store(Request $request) { // une variable de type 'Request'
        // on veut stocker les données dans la BDD

        // 1. mise en place des règles de validation
        $validator = Validator::make($request->all(),
            // on prend en compte toutes les requêtes qu'on transfert à la fonction 'make' de Validator

            // premier tableau : règles de validation pour chaque input
            [
                "first_name" => ["required", "string", "min:2", "max:255"],
                "last_name" => ["required", "string", "min:2", "max:255"],
                "age" => ["required", "integer", "between:0,150"],
                "email"=> ["required", "email", "unique:contacts"], // email unique dans la table 'contacts' de la BDD
                "tel" => ["required", "unique:contacts", "regex:/^[0-9\s\-\+\.\/]{5,20}$/"] 
                    // regex : on veut uniquement des chiffres, mais on accepte aussi les espaces, les '-', les '+', les '.', les slash, et on veut entre 5 et 20 caractères. Comme on a commencé par un '^' (= on veut uniquement...), il faut finir le regex par un '$'
            ], 

            // second tableau : messages pour chaque type d'exception
            // (on les réassigne car ils apparaissent en anglais par défaut)
            [
                "first_name.required" => "Ce champ est obligatoire.", 
                "first_name.string" => "Veuillez entrer un prénom valide.", 
                "first_name.min" => "Veuilez entrer au minimum 2 caractères.", 
                "first_name.max" => "Veuilez entrer au maximum 250 caractères.", 

                "last_name.required" => "Ce champ est obligatoire.",
                "last_name.string" => "Veuillez entrer un nom valide.",
                "last_name.min" => "Veuilez entrer au minimum 2 caractères.",
                "last_name.max" => "Veuilez entrer au maximum 250 caractères.",

                "age.required" => "Ce champ est obligatoire.",
                "age.integer" => "Chiffres uniquement.",
                "age.between" => "Votre âge doit être compris entre 0 et 150.",

                "email.required" => "Ce champ est obligatoire.",
                "email.email" => "Veuillez entrer un email valide.",
                "email.unique" => "Cet email est déjà pris.",

                "tel.required" => "Ce champ est obligatoire.",
                "tel.unique" => "Ce numéro de téléphone est déjà assigné.",
                "tel.regex" => "Veuillez entrer un numéro de téléphone valide."
            ]
        );

        // 2. si erreur, on redirige sur la page précédente avec les données récupérée
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 3. si aucune erreur, on stocke les données dans la BDD
        Contact::create([
            "first_name" => $request->first_name, // "first_name" c'est le nom de la colonne dans la BDD, pas la variable
            "last_name" => $request->last_name,
            "age" => $request->age,
            "email" => $request->email,
            "tel" => $request->tel
        ]);

        // 6. il faut demander au manager d'autoriser le remplissage de la BDD
            // ça se passe dans App/Models/Contact.php

        // 5. redirection
        return redirect()->route("contact.index")->with([
            "success" => "Le contact a été ajouté avec succès."
        ]);

        // return view("store");
            // on aurait pu faire ça, mais là on ne passe pas par le router
            // et il y aurait aussi une perte de données, apparemment ?
    }

    public function edit($id) { // l'edit récupère l'id depuis la route
        $contact = Contact::find($id); // "SELECT * FROM contacts WHERE id=:id
            // find permet de faire une requête en se basant sur l'id

        return view("edit", compact('contact'));
            // on retourne la vue 'edit' à laquelle on ajoute $contact pour pouvoir modifier ce contact et lui seulement
    }

    public function update(Request $request, $id) {
        $contact = Contact::where("id", $id)->first();
        // cette syntaxe équivaut à 'Contact::find($id);'
        // "cherche dans la bdd à "id" et si tu trouves, renvoie la première correspondance" (on aura donc un résultat unique)
        // pour plusieurs résultats, on utilisera 'get()' à la place de 'first()'

        
    }
}
