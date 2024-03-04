export class Coche {
    matricula: string;      // Primary Key
    precio: number;
    estado: boolean;
    kms: number;
    fecha: Date
    modelo: string

    constructor(matricula:string, precio:number, 
        estado:boolean, kms:number, fecha:Date, modelo: string){
        this.matricula = matricula;
        this.precio = precio;
        this.estado = estado;
        this.kms = kms;
        this.fecha = fecha
        this.modelo = modelo;
    }
}
