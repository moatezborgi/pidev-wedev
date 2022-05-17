/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.myapp.entities;

/**
 *
 * @author karim
 */
public class Reclamation {

    float id;
    String type_reclamation_id;
    float reclamationtype_id;

  
    String description;
    float count;
    String dateFac;
    String remboursement;

    public Reclamation(float id, float reclamationtype_id, String description, float count, String remboursement) {
        this.id = id;
        this.reclamationtype_id = reclamationtype_id;
        this.description = description;
        this.count = count;
        this.remboursement = remboursement;
    }

    public Reclamation(float reclamationtype_id, String description, float count, String dateFac, String remboursement) {
        this.reclamationtype_id = reclamationtype_id;
        this.description = description;
        this.count = count;
        this.dateFac = dateFac;
        this.remboursement = remboursement;
    }

    public Reclamation() {
    }

    public float getId() {
        return id;
    }

    public void setId(float id) {
        this.id = id;
    }

    public String getType_reclamation_id() {
        return type_reclamation_id;
    }

    public void setType_reclamation_id(String type_reclamation_id) {
        this.type_reclamation_id = type_reclamation_id;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public float getCount() {
        return count;
    }

    public void setCount(float count) {
        this.count = count;
    }

    public String getDateFac() {
        return dateFac;
    }

    public void setDateFac(String dateFac) {
        this.dateFac = dateFac;
    }

    public String getRemboursement() {
        return remboursement;
    }

    public void setRemboursement(String remboursement) {
        this.remboursement = remboursement;
    }
  public float getReclamationtype_id() {
        return reclamationtype_id;
    }

    public void setReclamationtype_id(float reclamationtype_id) {
        this.reclamationtype_id = reclamationtype_id;
    }
}
