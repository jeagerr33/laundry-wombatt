package com.example.demo.PelangganView;


import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/pelanggan")
public class PelangganViewRestController {

    @Autowired
    private JdbcTemplate jdbcTemplate;


    @PostMapping
    public ResponseEntity<String> addPelanggan(@RequestBody Map<String, Object> pelanggan) {
    try {
        String sql = "INSERT INTO pelanggan (nama, no_hp, kelurahan_id) VALUES (?, ?, ?)";
        jdbcTemplate.update(sql,
                pelanggan.get("nama"),
                pelanggan.get("noHP"),
                pelanggan.get("kelurahan_id"));
        return ResponseEntity.ok("Pelanggan berhasil ditambahkan.");
    } catch (Exception e) {
        e.printStackTrace();
        return ResponseEntity.status(500).body("Gagal menambahkan pelanggan: " + e.getMessage());
    }
}

@PutMapping("/{id}")
public ResponseEntity<String> editPelanggan(@PathVariable int id, @RequestBody Map<String, Object> pelanggan) {
    try {
        String sql = "UPDATE pelanggan SET nama = ?, no_hp = ?, kelurahan_id = ? WHERE id = ?";
        int rowsAffected = jdbcTemplate.update(sql,
                pelanggan.get("nama"),
                pelanggan.get("noHP"),
                pelanggan.get("kelurahan_id"),
                id);

        if (rowsAffected == 0) {
            return ResponseEntity.status(404).body("Pelanggan dengan ID " + id + " tidak ditemukan.");
        }
        return ResponseEntity.ok("Pelanggan berhasil diupdate.");
    } catch (Exception e) {
        e.printStackTrace();
        return ResponseEntity.status(500).body("Gagal mengedit pelanggan: " + e.getMessage());
    }
}

@DeleteMapping("/{id}")
public ResponseEntity<String> deletePelanggan(@PathVariable int id) {
    try {
        String sql = "DELETE FROM pelanggan WHERE id = ?";
        int rowsAffected = jdbcTemplate.update(sql, id);

        if (rowsAffected == 0) {
            return ResponseEntity.status(404).body("Pelanggan dengan ID " + id + " tidak ditemukan.");
        }
        return ResponseEntity.ok("Pelanggan berhasil dihapus.");
    } catch (Exception e) {
        e.printStackTrace();
        return ResponseEntity.status(500).body("Gagal menghapus pelanggan: " + e.getMessage());
    }
}


}