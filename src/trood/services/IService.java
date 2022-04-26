/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package trood.services;
import java.util.List;
/**
 *
 * @author Rania
 */
public interface IService <T>{
     public void ajouter(T p);
     public void supprimer(String id);
     public void modifier(T p);
     public List<T> getAll();
   
    
}
