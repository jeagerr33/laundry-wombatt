package com.example.demo.Pelanggan;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.dao.EmptyResultDataAccessException;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;

@Controller
@RequestMapping("/login-pelanggan")
public class PelangganController {

    @Autowired
    private JdbcTemplate jdbcTemplate;

    // Menampilkan halaman login
    @GetMapping
    public String showLoginForm(Model model) {
        model.addAttribute("pelanggan", new Pelanggan()); // Assuming you have a Pelanggan class
        return "pelanggan"; // Mengarahkan ke pelanggan.html
    }

    // Memproses login
    @PostMapping
    public String processLogin(
            @RequestParam("username") String username,
            Model model) {

        if (username.isEmpty()) {
            model.addAttribute("error", "Username tidak boleh kosong.");
            return "pelanggan"; // Tetap tampilkan halaman login dengan pesan error
        }

        // Query untuk validasi username di database
        String sql = "SELECT * FROM Pelanggan WHERE nama = ?";
        try {
            Pelanggan pelanggan = jdbcTemplate.queryForObject(sql, new Object[]{username}, this::mapRowToPelanggan);

            // Jika ditemukan, tampilkan pesan sukses
            model.addAttribute("message", "Login berhasil! Selamat datang, " + pelanggan.getNama());
            return "home"; // Arahkan ke halaman home setelah login berhasil
        } catch (EmptyResultDataAccessException e) {
            // Jika tidak ditemukan, tampilkan pesan error
            model.addAttribute("error", "Username tidak ditemukan. Silakan coba lagi.");
            return "pelanggan"; // Tetap tampilkan halaman login dengan pesan error
        } catch (Exception e) {
            // Tangani kesalahan lain jika perlu
            model.addAttribute("error", "Terjadi kesalahan. Silakan coba lagi.");
            return "pelanggan"; // Tetap tampilkan halaman login dengan pesan error
        }
    }

    // Helper method untuk memetakan hasil query ke objek Pelanggan
    private Pelanggan mapRowToPelanggan(ResultSet resultSet, int rowNum) throws SQLException {
        return new Pelanggan(
            resultSet.getInt("id"),
            resultSet.getString("nama"),
            resultSet.getString("noHP"),
            resultSet.getString("email")
        );
    }
}

/*package com.example.demo;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class PelangganController {

    @GetMapping("/login-pelanggan")
    public String home() {
        return "pelanggan";
    }
}*/
