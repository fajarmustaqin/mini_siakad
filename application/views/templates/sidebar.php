<div id="layoutSidenav">
    
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">
                    <?php
                    if($this->session->userdata('id_group') ==1){ 
                    ?>
                        Administrator
                    <?php 
                        }else if($this->session->userdata('id_group') == 2){
                    ?>
                        Admin Baak
                    <?php
                        }else if($this->session->userdata('id_group') == 3){
                    ?>
                        Dosen
                    <?php
                        }else if($this->session->userdata('id_group') == 4){
                    ?>   
                        Mahasiswa
                    <?php
                        }
                    ?>
                </div>
                
                <!-- sidebar dashboard -->
                <a class="nav-link" href="<?php echo base_url('dashboard')?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>


                <!-- sidebar mahasiswa -->
                <?php if($this->session->userdata('id_group') == 4) { ?>

                    <a href="<?= base_url('bimbingan') ?>" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Data Pribadi
                    </a>

                    <a href="<?= base_url('bimbingan/dosenPebimbing') ?>" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        Dosen Pebimbing
                    </a>
                
                <?php } ?>
                <!-- end sidebar mahasiswa -->


                <!-- sidebar admin -->
                <?php if($this->session->userdata('id_group') == 1 || $this->session->userdata('id_group') == 2){ ?>

                    <div class="sb-sidenav-menu-heading">Master</div>
                    <a class="nav-link" href="<?= base_url('dosen') ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        Dosen
                    </a>

                    <a href="<?= base_url('mahasiswa')?>" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-sharp fa-solid fa-graduation-cap"></i></div>
                        Mahasiswa
                    </a>

                    <?php if($this->session->userdata('id_group') == 1){ ?>
                        <div class="sb-sidenav-menu-heading">Setting</div>
                        <a href="<?= base_url('akun')?>" class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Akun
                        </a>
                    <?php } ?>

                    <a href="<?= base_url('ConsumeApi'); ?>" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-globe"></i></div>
                        Consume Api
                    </a>
                <?php } ?>
                <!-- end sidebar admin -->


                <!-- sidebar dosen -->
                <?php if($this->session->userdata('id_group') == 3){ ?>
                    <a href="<?= base_url('pebimbing')?>" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Data Pribadi
                    </a>
                    <a href="<?= base_url('pebimbing/showMahasiswa')?>" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-sharp fa-solid fa-graduation-cap"></i></div>
                        Mahasiswa
                    </a>
                <?php } ?>
                <!-- end sidebar dosen -->

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
                <?php
                if($this->session->userdata('id_group')==1){ 
                ?>
                    Administrator
                <?php 
                    }else if($this->session->userdata('id_group') == 2){
                ?>
                    Admin Baak
                <?php
                    }else if($this->session->userdata('id_group') == 3){
                ?>
                    Dosen
                <?php
                    }else if($this->session->userdata('id_group') == 4){
                ?>   
                    Mahasiswa
                <?php
                    }
                ?>


        </div>
    </nav>
</div>