<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stand>
 */
class StandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement($this->fakeNames()),
        ];
    }

    /**
     * @return array
     */
    private function fakeNames()
    {
        return [
            "Banca das Delícias",
            "Rincão dos Sabores",
            "Doces e Delícias",
            "Cantinho dos Petiscos",
            "Sabor à Vista",
            "Café & Companhia",
            "Tudo em Grelhados",
            "Feira das Flores",
            "Artesanato em Festa",
            "Aromas e Sabores",
            "Mundo dos Doces",
            "Esquina das Ervas",
            "Lanches da Praça",
            "Rústico & Saboroso",
            "Bebidas Refrescantes",
            "Feira das Artes",
            "Frutas do Dia",
            "Doçuras à Venda",
            "Pão & Companhia",
            "Amor à Primeira Mordida",
            "Cantinho das Lembranças",
            "Tesouros da Feira",
            "Especialidades da Casa",
            "Delícias no Palito",
            "Bistrô dos Sabores",
            "Estação das Delícias",
            "Rapidinho & Gostoso",
            "Cantinho das Flores",
            "Sabor Simplesmente",
            "Lanches e Sorrisos",
            "Aromas da Natureza",
            "Prazeres na Banca",
            "Tesouros do Sabor",
            "Bebidas e Sorvetes",
            "Sabores da Estação",
            "Cantinho das Artes",
            "Refeições à Mão",
            "Prazeres da Grelha",
            "Coisas Doces da Vida",
            "Comida de Rua Gourmet",
            "Artesanato à Venda",
            "Momentos de Sabor",
            "Café da Manhã Feliz",
            "Sabores Exóticos",
            "Gostinho Caseiro",
            "Artesanato e Mimos",
            "Bebidas Frescas",
            "Sabor com Amor",
            "Comidas Saborosas",
            "Encontro de Aromas"
        ];
    }
}
