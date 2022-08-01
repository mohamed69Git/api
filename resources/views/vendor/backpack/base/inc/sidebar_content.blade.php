<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('state') }}'><i class='nav-icon la la-question'></i>
        Etat du Quiz</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('quiz') }}'><i class='nav-icon la la-question'></i>
        Nouveau Quiz</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('question') }}'><i class='nav-icon la la-question'></i>
        Questions du Quiz</a></li>
{{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('role') }}'><i class='nav-icon la la-question'></i> Roles</a></li> --}}
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('reponse') }}'><i class='nav-icon la la-question'></i>
        Reponses</a></li>
{{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-question'></i>
        Candidat</a></li> --}}
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('resultat') }}'><i class='nav-icon la la-question'></i>
        Résultats</a></li>
