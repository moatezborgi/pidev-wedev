  /*
 * Copyright (c) 2016, Codename One
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions 
 * of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF 
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE 
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
 */
package com.mycompany.myapp.gui;


import com.codename1.capture.Capture;
import com.codename1.components.FloatingHint;
import com.codename1.components.ToastBar;
import com.codename1.io.FileSystemStorage;
import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.spinner.Picker;
import com.codename1.ui.util.ImageIO;
import com.codename1.ui.util.Resources;
import com.codename1.ui.validation.RegexConstraint;
import com.codename1.ui.validation.Validator;
import com.mycompany.myapp.services.ServiceUsers;

import java.io.IOException;
import java.io.OutputStream;

import java.util.Random;

import java.util.Vector;

/**
 * Signup UI
 *
 * @author Shai Almog
 */
public class SignUpForm extends BaseForm {

    String fileName = null, imgtype;

    public SignUpForm(Resources res) {
        super(new BorderLayout());
        Toolbar tb = new Toolbar(true);
        setToolbar(tb);
        tb.setUIID("Container");
        getTitleArea().setUIID("Container");
        Form previous = Display.getInstance().getCurrent();
        tb.setBackCommand("", e -> previous.showBack());
        setUIID("SignIn");

        TextField nom = new TextField("", "Nom", 20, TextField.ANY);
        TextField prenom = new TextField("", "Prenom", 20, TextField.ANY);
        TextField tel = new TextField("", "Numero tel", 20, TextField.PHONENUMBER);
        ComboBox genre = new ComboBox<>();
        genre.addItem("Choisir votre sexe");
        genre.addItem("Homme");
        genre.addItem("Femme");

        TextField email = new TextField("", "E-Mail", 20, TextField.EMAILADDR);
        //valdator email
        Validator validator = new Validator();
        validator.addConstraint(email, RegexConstraint.validEmail());
        RegexConstraint emailConstraint = new RegexConstraint("^[(a-zA-Z-0-9-\\_\\+\\.)]+@[(a-z-A-z)]+\\.[(a-zA-z)]{2,3}$", "Invalid Email Address");
        validator.addConstraint(email, emailConstraint);

        TextField password = new TextField("", "Password", 20, TextField.PASSWORD);
        TextField confirmPassword = new TextField("", "Confirm Password", 20, TextField.PASSWORD);
        nom.setSingleLineTextArea(false);
        prenom.setSingleLineTextArea(false);
        tel.setSingleLineTextArea(false);
        email.setSingleLineTextArea(false);
        password.setSingleLineTextArea(false);
        confirmPassword.setSingleLineTextArea(false);
        Button next = new Button("Next");
        Button signIn = new Button("Sign In");
        signIn.addActionListener(e -> previous.showBack());
        signIn.setUIID("Link");
        Label alreadHaveAnAccount = new Label("Already have an account?");
//upload

        Button btnCapture = new Button("Upload Image");
        Label limage = new Label();
        limage.setHeight(150);
        limage.setWidth(150);

        btnCapture.addActionListener((e) -> {
            String path = Capture.capturePhoto(Display.getInstance().getDisplayWidth(), -1);
            // System.out.println(path);
            if (path != null) {
                try {
                    int height = Display.getInstance().convertToPixels(31.5f);
                    int width = Display.getInstance().convertToPixels(34f);

                    Image img = Image.createImage(path);
                    System.out.println(path);
                    int fileNameIndex = path.lastIndexOf("/") + 1;
                    fileName = path.substring(fileNameIndex, path.length() - 5);
                    System.out.println(fileName);

                    int fileNameIndex1 = path.lastIndexOf(".") + 1;
                    imgtype = path.substring(fileNameIndex1, path.length());
                    System.out.println(imgtype);
                    System.out.println(path);
                    fileName += "." + imgtype;
                    System.out.println(fileName);

                    limage.setIcon(img.fill(width, height));
                    OutputStream os = FileSystemStorage.getInstance().openOutputStream(FileSystemStorage.getInstance().getAppHomePath() + fileName);

                    if (imgtype.equalsIgnoreCase("jpg")) {
                        ImageIO.getImageIO().save(img, os, ImageIO.FORMAT_JPEG, 0.9f);
                    } else {
                        ImageIO.getImageIO().save(img, os, ImageIO.FORMAT_PNG, 0.9f);
                    }
                    os.close();
                    this.revalidate();

                } catch (IOException ex) {
                    ex.printStackTrace();
                }
            }
        });
//upload
//date
        Picker datePicker = new Picker();
        datePicker.setType(Display.PICKER_TYPE_DATE);

//date
        Container content = BoxLayout.encloseY(
                new Label("Sign Up", "LogoLabel"),
                new FloatingHint(nom),
                createLineSeparator(),
                new FloatingHint(prenom),
                new FloatingHint(tel),
                createLineSeparator(),
                datePicker,
                createLineSeparator(),
                genre,
                createLineSeparator(),
                BoxLayout.encloseX(BoxLayout.encloseX(btnCapture, limage)),
                createLineSeparator(),
                new FloatingHint(email),
                createLineSeparator(),
                new FloatingHint(password),
                createLineSeparator(),
                new FloatingHint(confirmPassword),
                createLineSeparator()
        );
        content.setScrollableY(true);
        add(BorderLayout.CENTER, content);
        add(BorderLayout.SOUTH, BoxLayout.encloseY(
                next,
                FlowLayout.encloseCenter(alreadHaveAnAccount, signIn)
        ));
        next.requestFocus();
        next.addActionListener(e -> {
            Boolean verifier = true;
            if (nom.getText().length() == 0 || prenom.getText().length() == 0 || genre.getSelectedItem().toString().length() == 0
                    || email.getText().length() == 0 || tel.getText().length() == 0
                    || password.getText().length() == 0 || fileName == null) {
                verifier = false;
                ToastBar.showMessage("don't leave empty field", FontImage.MATERIAL_INFO);
            } else if (Valider_MDP(password.getText()) == false) {
                verifier = false;
                ToastBar.showMessage("mot de passe need 1 min 1 maj and numbers", FontImage.MATERIAL_INFO);
            } else if (!password.getText().equalsIgnoreCase(confirmPassword.getText())) {
                verifier = false;
                ToastBar.showMessage("mdp not the same", FontImage.MATERIAL_INFO);
            } else if (!validator.isValid()) {
                verifier = false;
                ToastBar.showMessage("email format warning", FontImage.MATERIAL_INFO);
            }
            ServiceUsers.getInstance().signup(nom.getText(), prenom.getText(), (String) genre.getSelectedItem(), email.getText(), datePicker.getText(), password.getText()
            );
new SignInForm(res).show();
            System.out.println(" nom " + nom.getText() + " prenom " + prenom.getText() + " passord " + password.getText() + " genre " + genre.getSelectedItem() + " image " + limage.getText() + " Date " + datePicker.getText());
        });
    }

    public boolean Valider_MDP(String Mdp) {
        if ((Compter_NB_MAJUS(Mdp) > 0) && (Compter_NB_MINUS(Mdp) > 0) && (Compter_NB_CHIFFRES(Mdp) > 0)) {
            return true;
        }
        return false;
    }

    public int Compter_NB_MAJUS(String Mdp) {
        int Cpt = 0, i;

        for (i = 0; i < Mdp.length(); i++) {
            if (Character.isUpperCase(Mdp.charAt(i))) {
                Cpt++;
            }

        }
        return Cpt;
    }

    public int Compter_NB_MINUS(String Mdp) {
        int Cpt = 0, i;

        for (i = 0; i < Mdp.length(); i++) {
            if (Character.isLowerCase(Mdp.charAt(i))) {
                Cpt++;
            }

        }
        return Cpt;
    }

    public int Compter_NB_CHIFFRES(String Mdp) {
        int Cpt = 0, i;

        for (i = 0; i < Mdp.length(); i++) {
            if (Mdp.charAt(i) >= '0' && Mdp.charAt(i) <= '9') {
                Cpt++;
            }
        }
        return Cpt;
    }

}