<div class="modal fade" id="modalForm" padding-right: 17px;" aria-modal="true" role="dialog" data-backdrop="static" data_keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">

                       

                         <!-- Add Nama  -->
                        <label class="" for="nama">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama')}}" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                         <!-- Add Kelas 
                         <label class="" for="kelas">Kelas</label>
                        <input type="text" name="kelas" id="kelas" value="{{ old('kelas')}}" class="form-control @error('kelas') is-invalid @enderror">
                        @error('kelas')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror -->

                         <!-- Add Jurusan  -->
                       <label class="mt-2" for="jurusan">Jurusan</label>
                        <select type="text" name="jurusan" id="jurusan" value="{{ old('jurusan')}}" class="form-control @error('jurusan') is-invalid @enderror">
                            <option selected>Pilih...</option>
                            @foreach($jurusan as $jurusan)
                                <option value="{{$jurusan->id}}">{{$jurusan->nama}}</option>
                            @endforeach
                        @error('jurusan')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </select> 

                         <!-- Add Nama  -->
                         <label class="" for="asal_sekolah">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ old('asal_sekolah')}}" class="form-control @error('asal_sekolah') is-invalid @enderror">
                        @error('asal_sekolah')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror

                         
                        
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

</div>