/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package trood.entity;

/**
 *
 * @author Rania
 */
public class Categorie {
    private int id;
    private String lib_cat;

    public Categorie(int id, String lib_cat) {
        this.id = id;
        this.lib_cat = lib_cat;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getLib_cat() {
        return lib_cat;
    }

    public void setLib_cat(String lib_cat) {
        this.lib_cat = lib_cat;
    }

    @Override
    public String toString() {
        return "Categorie{" + "id=" + id + ", lib_cat=" + lib_cat + '}';
    }

    public Categorie(String lib_cat) {
        this.lib_cat = lib_cat;
    }
   
    
    
}
