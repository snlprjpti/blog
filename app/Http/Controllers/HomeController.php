<?php

namespace App\Http\Controllers;

use App\Faces;
use Google\Cloud\Core\ServiceBuilder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function face()
    {
        $cloud = new ServiceBuilder([
            'keyFilePath' => base_path('faceRecognition-c9f572f367a7.json'),
            'projectId' => 'facerecognition-231608'
        ]);
        $vision = $cloud->vision();
        $output = imagecreatefromjpeg(public_path('friends.jpg'));
        $image = $vision->image(file_get_contents(public_path('friends.jpg')), ['FACE_DETECTION']);
        $results = $vision->annotate($image);

        foreach ($results->faces() as $face) {
            $vertices = $face->boundingPoly()['vertices'];

            $x1 = $vertices[0]['x'];
            $y1 = $vertices[0]['y'];
            $x2 = $vertices[2]['x'];
            $y2 = $vertices[2]['y'];

            imagerectangle($output, $x1, $y1, $x2, $y2, 0x00ff00);
        }
    }

    public function facejs()
    {

        return view('face');
    }

    public function faceDetails(Request $request)
    {
        $data = $request->all();
        foreach ($data as $d) {
            foreach ($d as $data) {

                $result['confidence'] = $data['confidence'];
                $result['height'] = $data['height'];
                $result['neighbors'] = $data['neighbors'];
                $result['offsetX'] = $data['offsetX'];
                $result['offsetY'] = $data['offsetY'];
                $result['positionX'] = $data['positionX'];
                $result['positionY'] = $data['positionY'];
                $result['scaleX'] = $data['scaleX'];
                $result['scaleY'] = $data['scaleY'];
                $result['width'] = $data['width'];
                $result['x'] = $data['x'];
                $result['y'] = $data['y'];
                $files = Faces::create($result);
            }

            session()->flash('success', 'Successfully Updated!');
        }
    }
}
