
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Contestify</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Contestify</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-body">
                                En tant <?php if($_SESSION['role']=="J") {
                                echo "que Jury";
                            } else {
                                echo "qu'Administrateur";
                            }; ?>, accédez à vos outils.
                            </div>
                    </div>
            
                </main>
            </div>