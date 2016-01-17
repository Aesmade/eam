<?php
    include 'include/php/header.php';
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Κεντρική</a></li>
            <li><a href="#">Αναζήτηση</a></li>
            <li><span class="active">Αποτελέσματα</span></li>
        </ol>
        <div class="flex-container space-between">
            <h3>Αποτελέσματα 1-3 από 3 για "όροι αναζήτησης"</h3>
            <div class="form-group form-inline">
                <label for="ordering">Ταξινόμηση κατά&nbsp;</label>
                <select name="" id="ordering" class="form-control">
                    <option value="">Συνάφεια</option>
                    <option value="">Όνομα</option>
                    <option value="">Ημερομηνία</option>
                    <option value="">Κατηγορία</option>
                </select>
            </div>
        </div>
        <div class="search-result row spacing-top">
            <div class="col-sm-2"><img src="resources/img.gif" alt=""></div>
            <div class="col-sm-5">
                <h4>
                    <a href="#">1. Τίτλος 1</a>
                    <div class="flex-container space-between spacing-top">
                        <div>
                            <div>Από: Όνομα Επώνυμο</div>
                            <div>Κατηγορία: Πληροφορική</div>
                        </div>
                        <div>
                            <div>Έτος: 2015</div>
                            <div>Γλώσσα: Ελληνικά</div>
                        </div>
                    </div>
                </h4>
            </div>
            <div class="col-sm-2 col-sm-offset-2 spacing-top">
                <button class="btn btn-default">Προσθήκη στη λίστα μου</button>
            </div>
        </div>
        <div class="search-result row">
            <div class="col-sm-2"><img src="resources/img.gif" alt=""></div>
            <div class="col-sm-5">
                <h4>
                    <a href="#">2. Τίτλος 2</a>
                    <div class="flex-container space-between spacing-top">
                        <div>
                            <div>Από: Όνομα Επώνυμο</div>
                            <div>Κατηγορία: Πληροφορική</div>
                        </div>
                        <div>
                            <div>Έτος: 2015</div>
                            <div>Γλώσσα: Ελληνικά</div>
                        </div>
                    </div>
                </h4>
            </div>
            <div class="col-sm-2 col-sm-offset-2 spacing-top">
                <button class="btn btn-default">Προσθήκη στη λίστα μου</button>
            </div>
        </div>
        <div class="search-result row">
            <div class="col-sm-2"><img src="resources/img.gif" alt=""></div>
            <div class="col-sm-5">
                <h4>
                    <a href="#">3. Τίτλος 3</a>
                    <div class="flex-container space-between spacing-top">
                        <div>
                            <div>Από: Όνομα Επώνυμο</div>
                            <div>Κατηγορία: Πληροφορική</div>
                        </div>
                        <div>
                            <div>Έτος: 2015</div>
                            <div>Γλώσσα: Ελληνικά</div>
                        </div>
                    </div>
                </h4>
            </div>
            <div class="col-sm-2 col-sm-offset-2 spacing-top">
                <button class="btn btn-default">Προσθήκη στη λίστα μου</button>
            </div>
        </div>
        <nav class="text-center spacing-top-large">
            <ul class="pagination">
                <li class="disabled">
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li class="disabled">
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <?php
    include 'include/php/footer.php';
?>
