package com.example.demo.MesinCuciStuff;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class MesinCuciContoller {
    @GetMapping("/mesinCuci")
    public String homeStaff() {
        return "mesinCuciStuff";
    }
}
