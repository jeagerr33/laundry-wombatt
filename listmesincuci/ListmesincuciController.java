package com.example.demo.Listmesincuci;


import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import ch.qos.logback.core.model.Model;

@Controller
@RequestMapping("/mesincuci")
public class ListmesincuciController {

    @Autowired
    private JdbcTemplate jdbcTemplate;

    @GetMapping("/list")
    public String listMesinCuci(Model model) {
        String sql = "SELECT * FROM Mesin_Cuci";
        List<Map<String, Object>> mesinCuciList = jdbcTemplate.queryForList(sql);
        model.addAttribute("mesinCuciList", mesinCuciList);
        return "list-mesincuci";
    }
}