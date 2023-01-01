<?php $this->extend('templates/main'); ?>

<?php $this->section('contents') ?>

<div id="v-alokasi">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Alokasi</h3>
                <div class="nk-block-des text-soft">
                    <p>Manajemen alokasi aset</p>
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row">
            <div class="col-md-4">
                <input type="hidden" ref="userlev" value="<?= $_SESSION['level']; ?>">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <select class="form-select" v-model="opt_status">
                            <option value="all">All</option>
                            <option value="book">Book</option>
                            <option value="allocated">Allocated</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="form-control-wrap mb-2">
                    <div class="input-group">
                        <input type="text" v-model="search" class="form-control" placeholder="Search by aset">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary btn-dim"><em class="icon ni ni-search"></em></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card card-bordered mb-4">
                <table class="table">
                    <thead style="height: 40px; vertical-align: middle;">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Aset</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Book Qty</th>
                            <th scope="col">Book Date</th>
                            <th scope="col">User</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="vertical-align: middle;" v-for="(item, index) in items">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ item.nama }}</td>
                            <td>{{ item.jumlah }} ({{ item.satuan }})</td>
                            <td>{{ item.book_qty }} ({{ item.satuan }})</td>
                            <td>{{ item.booked_atx }}</td>
                            <td>{{ item.book_user }}</td>
                            <td>
                                <span 
                                    class="text-bold" 
                                    v-bind:class="{'text-warning': item.book_status == 'book', 'text-dark': item.book_status == 'allocated', 'text-danger': item.book_status == 'rejected'}">{{ item.book_status}}</span>
                            </td>
                            <td><button data-bs-toggle="modal" data-bs-target="#modalDetails" v-on:click="fetchDetails($event, item.id, item.book_id)" style="float: right;" class="btn btn-icon btn-secondary btn-table-sm"><em class="icon ni ni-file-text"></em></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="col-sm-12">
                <span class="pagination justify-content-center justify-content-md-start" v-if="items !== null">
                    <paginate 
                        first-last-button
                        :page-count="getPageCount" 
                        :page-range="3" 
                        :margin-pages="1" 
                        :click-handler="clickCallback" 
                        :disabled-class="'disabled'"
                        :active-class="'active'"
                        :prev-link-class="'page-link'"
                        :prev-text="'<'" 
                        :next-link-class="'page-link'"
                        :next-text="'＞'"
                        :container-class="'pagination'" 
                        :page-class="'page-item'"
                        :page-link-class="'page-link'">
                    </paginate>
                </span>
            </div>
            </div>
        </div>
        
        
    </div><!-- .nk-block -->
    <div class="modal fade" tabindex="-1" id="modalDetails">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" ref="baka" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Detail</h5>
                </div>
                <div class="modal-body">
                    <div class="form-validate is-alter">
                        <div class="row gy-3 mb-3">
                            <span class="gallery-image">
                                <img class="w-100 rounded-top f-500" :src="details.foto" alt="">
                            </span>
                        </div>
                        <div class="row gy-3">
                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <h4 class="product-title text-capitalize">{{ details.nama }}</h4>
                                    <span class="lead-text text-capitalize">
                                        <span style="width: 20px;">{{ details.uraian }}</span> 
                                    </span>
                                    <br>
                                    <span class="lead-text text-capitalize">
                                        <span class="d-sm-inline-block" style="width: 120px;"><em class="icon ni ni-check"></em> Merk</span>: {{ details.merk }}  
                                    </span> 
                                    <span class="lead-text text-capitalize">
                                        <span class="d-sm-inline-block" style="width: 120px;"><em class="icon ni ni-check"></em> Jenis</span>: {{ details.jenis }} 
                                    </span>
                                    <span class="lead-text text-capitalize">
                                        <span class="d-sm-inline-block" style="width: 120px;"><em class="icon ni ni-check"></em> Kondisi</span>: {{ details.kondisi }} 
                                    </span>
                                    <span class="lead-text text-capitalize">
                                        <span class="d-sm-inline-block" style="width: 120px;"><em class="icon ni ni-check"></em> Status/Stock</span>: {{ details.status }} ({{ details.jumlah }} {{ details.satuan }}) 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <div class="form-control-wrap number-spinner-wrap" style="width: 140px; float: right;">
                                            <button class="btn btn-icon btn-primary number-spinner-btn number-minus" data-number="minus">
                                                <em class="icon ni ni-minus"></em>
                                            </button>
                                            <input type="number" ref="qx" class="form-control number-spinner" :value="qty" :min="min" :max="details.jumlah">
                                            <button class="btn btn-icon btn-primary number-spinner-btn number-plus" data-number="plus">
                                                <em class="icon ni ni-plus"></em>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-2">
                                        <button style="float: right; margin-left: 3px;" type="submit" class="btn btn-md" v-bind:class = "(bid !== null) ? 'btn-danger' : 'btn-primary'" v-on:click="reject($event)">Reject</button>
                                        <button type="submit" class="btn btn-md" v-bind:class="(bid !== null) ? 'btn-success' : 'btn-primary'" style="float: right;" v-on:click="allocated($event)">Allocated</button>
                                    </div>
                                    <div class="col-sm-12 mt-2">
                                        <div class="alert alert-success alert-icon" v-show="linfo">
                                            <em class="icon ni ni-check-circle"></em><strong>{{ ainfo }}</strong>
                                        </div>
                                        <div class="loading-info" style="float: right;" v-show="loading">
                                            <span><img src="<?= base_url('assets/images/utils/loading.svg'); ?>"> Processing..</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection() ?>