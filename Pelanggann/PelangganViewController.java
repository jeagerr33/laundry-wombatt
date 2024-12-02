package com.example.demo.PelangganView;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import java.util.List;
import java.util.Map;

@Controller
public class PelangganViewController {

    @Autowired
    private JdbcTemplate jdbcTemplate;

    @GetMapping("/pelanggan")
    public String viewPelanggan(Model model) {
        
        String sql = "SELECT * FROM pelanggan";
        List<Map<String, Object>> pelangganList = jdbcTemplate.queryForList(sql);

        model.addAttribute("pelangganList", pelangganList);

        return "pelangganView";
    }
}
