<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'title'             => 'Produtos',
            'summary'           => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim exc.',
            'text'              => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates?',
            'banner'            => '',
            'type'              => 'product',
            'show_form'         => 0,
            'status_id'         => 1,
            'configuration_id'  => 1
        ]);
        DB::table('pages')->insert([
            'title'             => 'Contato',
            'summary'           => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim exc.',
            'text'              => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates?',
            'banner'            => '',
            'type'              => 'contact',
            'show_form'         => 0,
            'status_id'         => 1,
            'configuration_id'  => 1
        ]);
        DB::table('pages')->insert([
            'title'             => 'Sobre',
            'summary'           => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim exc.',
            'text'              => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates?',
            'banner'            => '',
            'type'              => 'about',
            'show_form'         => 0,
            'status_id'         => 1,
            'configuration_id'  => 1
        ]);
        DB::table('pages')->insert([
            'title'             => 'Conteúdo',
            'summary'           => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim exc.',
            'text'              => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates?',
            'banner'            => '',
            'type'              => 'content',
            'show_form'         => 0,
            'status_id'         => 1,
            'configuration_id'  => 1
        ]);
        DB::table('pages')->insert([
            'title'             => 'Serviço',
            'summary'           => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim exc.',
            'text'              => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam aliquid amet, aut ea eaque eius enim excepturi harum, in molestiae nulla quae quasi quia rem rerum sed vitae voluptates?',
            'banner'            => '',
            'type'              => 'service',
            'show_form'         => 0,
            'status_id'         => 1,
            'configuration_id'  => 1
        ]);
    }
}
