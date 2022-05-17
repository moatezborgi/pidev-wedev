/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.myapp.entities;

/**
 *
 * @author karim
 */
public class TypeReclamation {
    float id;
String type;

    public TypeReclamation(float id, String type) {
        this.id = id;
        this.type = type;
    }

    public TypeReclamation(String type) {
        this.type = type;
    }

    public TypeReclamation() {
    }

    public float getId() {
        return id;
    }

    public void setId(float id) {
        this.id = id;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }


}
