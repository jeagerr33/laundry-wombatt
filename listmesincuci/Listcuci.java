package com.example.demo.Listmesincuci;

import lombok.*;

@Data
@NoArgsConstructor
@AllArgsConstructor
@Builder
public class Listcuci {
    private String nama;                
    private int kapasitas;             
    private String status;             
    private String merek;           
    private double hargaPer15Menit;     
}
