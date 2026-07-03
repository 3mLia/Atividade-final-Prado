<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::paginate(10);
        return view('services.index', compact('services'));
    }

    public function create(): View
    {
        return view('services.create');
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        // Salva DIRETAMENTE na pasta public/uploads/services
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/services'), $filename);
            $data['image_path'] = 'uploads/services/' . $filename;
        }

        Service::create($data);

        return redirect()->route('services.index')
            ->with('success', 'Serviço criado com sucesso!');
    }

    public function edit(Service $service): View
    {
        return view('services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Remove a foto antiga da pasta public, se existir
            if ($service->image_path && file_exists(public_path($service->image_path))) {
                unlink(public_path($service->image_path));
            }
            
            // Salva a nova foto
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/services'), $filename);
            $data['image_path'] = 'uploads/services/' . $filename;
        }

        $service->update($data);

        return redirect()->route('services.index')
            ->with('success', 'Serviço atualizado com sucesso!');
    }

    public function destroy(Service $service): RedirectResponse
    {
        // Remove a foto da pasta public quando apagar o serviço
        if ($service->image_path && file_exists(public_path($service->image_path))) {
            unlink(public_path($service->image_path));
        }
        
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Serviço removido com sucesso!');
    }
}