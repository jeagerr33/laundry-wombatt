package com.example.demo.HomeStaff;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class HomeStaff {
    @GetMapping("/homeStaff")
    public String homeStaff() {
        return "homeStaff";
    }
}
