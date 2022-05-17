/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.myapp.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.Dialog;
import com.codename1.ui.events.ActionListener;
import com.mycompany.myapp.entities.Reclamation;
import com.mycompany.myapp.utilis.Static;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

/**
 *
 * @author sarra
 */
public class ServiceReclamation {

    public ArrayList<Reclamation> Reclamation;

    public static ServiceReclamation instance = null;
    public boolean resultOK;
    private ConnectionRequest req;

    private ServiceReclamation() {
        req = new ConnectionRequest();
    }

    public static ServiceReclamation getInstance() {
        if (instance == null) {
            instance = new ServiceReclamation();
        }
        return instance;
    }

    public ArrayList<Reclamation> parseReclamation(String jsonText) {
        try {
            Reclamation = new ArrayList<>();
            JSONParser j = new JSONParser();// Instanciation d'un objet JSONParser permettant le parsing du résultat json

            /*
                On doit convertir notre réponse texte en CharArray à fin de
            permettre au JSONParser de la lire et la manipuler d'ou vient 
            l'utilité de new CharArrayReader(json.toCharArray())
            
            La méthode parse json retourne une MAP<String,Object> ou String est 
            la clé principale de notre résultat.
            Dans notre cas la clé principale n'est pas définie cela ne veux pas
            dire qu'elle est manquante mais plutôt gardée à la valeur par defaut
            qui est root.
            En fait c'est la clé de l'objet qui englobe la totalité des objets 
                    c'est la clé définissant le tableau de tâches.
             */
            Map<String, Object> ReclamationListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));

            /* Ici on récupère l'objet contenant notre liste dans une liste 
            d'objets json List<MAP<String,Object>> ou chaque Map est une tâche.               
            
            Le format Json impose que l'objet soit définit sous forme
            de clé valeur avec la valeur elle même peut être un objet Json.
            Pour cela on utilise la structure Map comme elle est la structure la
            plus adéquate en Java pour stocker des couples Key/Value.
            
            Pour le cas d'un tableau (Json Array) contenant plusieurs objets
            sa valeur est une liste d'objets Json, donc une liste de Map
             */
            List<Map<String, Object>> list = (List<Map<String, Object>>) ReclamationListJson.get("root");
            //Parcourir la liste des tâches Json
            for (Map<String, Object> obj : list) {
                //Création des tâches et récupération de leurs données
                Reclamation t = new Reclamation();
        Map<String, Object> type =(Map<String, Object>) obj.get("typeReclamation");

                float id = Float.parseFloat(obj.get("id").toString());
               // float idT = Float.parseFloat(obj.get("typeReclamation").toString());
                
                float c = Float.parseFloat(obj.get("count").toString());
                
                t.setId((int) id);
 
                t.setType_reclamation_id((String)type.get("type").toString()); 
                float ied = Float.parseFloat(type.get("id").toString());
t.setReclamationtype_id(ied);
                System.out.println(ied);  

                t.setDescription(obj.get("description").toString());
                t.setCount((int) c);
                t.setDateFac(obj.get("dateFac").toString());
                t.setRemboursement(obj.get("remboursement").toString());

                //Ajouter la tâche extraite de la réponse Json à la liste
                Reclamation.add(t);
            }

        } catch (IOException ex) {

        }
        /*
            A ce niveau on a pu récupérer une liste des tâches à partir
        de la base de données à travers un service web
        
         */
        return Reclamation;
    }

    public ArrayList<Reclamation> getAllReclamations() {
        ArrayList<Reclamation> listReclamation = new ArrayList<>();

        String url = Static.BASE_URL + "displayReclamationMobile";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                Reclamation = parseReclamation(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return Reclamation;
    }
    public ArrayList<Reclamation> getAllReclamationstri() {
        ArrayList<Reclamation> listReclamation = new ArrayList<>();

        String url = Static.BASE_URL + "triupMobilee";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                Reclamation = parseReclamation(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return Reclamation;
    }

    public boolean addReclamation(Reclamation t) {
        float id = 2;
        String url = Static.BASE_URL + "addReclamationMobile?type="+ t.getReclamationtype_id()+"&description="+t.getDescription()+"&count="+t.getCount()+"&remboursement="+t.getRemboursement(); //création de l'URL
        req.setUrl(url);// Insertion de l'URL de notre demande de connexion
        System.out.println(url);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this); //Supprimer cet actionListener
                /* une fois que nous avons terminé de l'utiliser.
                La ConnectionRequest req est unique pour tous les appels de 
                n'importe quelle méthode du Service task, donc si on ne supprime
                pas l'ActionListener il sera enregistré et donc éxécuté même si 
                la réponse reçue correspond à une autre URL(get par exemple)*/

            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }

    public void deletReclamation(float id) {

        Dialog d = new Dialog();
        if (d.show("Delete Reclamation", "Do you really want to remove this Reclamation", "Yes", "No")) {

            req.setUrl(Static.BASE_URL + "deleteReclamationMobile?id=" + id);
            //System.out.println(Statics.BASE_URL+"/deleteReclamationMobile?id="+id);
            NetworkManager.getInstance().addToQueueAndWait(req);

            d.dispose();
        }
    }

    public boolean updateReclamation(Reclamation t) {
        String url = Static.BASE_URL + "UpdateReclamationMobile?type="+ t.getReclamationtype_id()+"&description="+t.getDescription()+"&count="+t.getCount()+"&remboursement="+t.getRemboursement() + "&id=" + t.getId(); //création de l'URL
        System.out.println(url);
        req.setUrl(url);// Insertion de l'URL de notre demande de connexion
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this); //Supprimer cet actionListener
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }

}
