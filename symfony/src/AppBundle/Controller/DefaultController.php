<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            //'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'activemenu' => 'inicio'
        ]);
    }

    public function publicacionesAction(Request $request)
    {
        $trabajos = $this->get('lenguas.trabajos')->retrieveAllPublicacionesPerLetter($this->get('media_album_service'));
        return $this->render('default/publicaciones.html.twig', [
            'activemenu' => 'publicaciones',
            'trabajos' => $trabajos
        ]);
    }

    public function monografiagradoAction(Request $request)
    {
        $trabajos = $this->get('lenguas.trabajos')->retrieveAllMonografiasGradoPerLetter($this->get('media_album_service'));
        return $this->render('default/monografiagrado.html.twig', [
            'activemenu' => 'monografias',
            'activesubmenu' => 'grado',
            'trabajos' => $trabajos
        ]);
    }

    public function monografiaposgradoAction(Request $request)
    {
        $trabajos = $this->get('lenguas.trabajos')->retrieveAllMonografiasPosgradoPerLetter($this->get('media_album_service'));
        return $this->render('default/monografiaposgrado.html.twig', [
            'activemenu' => 'monografias',
            'activesubmenu' => 'posgrado',
            'trabajos' => $trabajos
        ]);
    }
    
    public function sitiosinteresAction(Request $request)
    {
        return $this->render('default/sitiosinteres.html.twig', [
            'activemenu' => 'sitiosinteres',
        ]);
    }

    public function colaboradoresAction(Request $request)
    {
        return $this->render('default/colaboradores.html.twig', [
            'activemenu' => 'colaboradores',
        ]);
    }

    public function menuDocumentosAction(Request $request)
    {
        $documents = $this->get('lenguas.documentos')->retrieveAllDocumentsForMenu();
        return $this->render('default/_menuDocumentos.html.twig', [
            'documents' => $documents,
        ]);
    }

    public function documentoAction(Request $request, $slug)
    {
        $documento = $this->get('lenguas.documentos')->retrieveBySlug($slug);
        if($documento === null){
          throw $this->createNotFoundException('No se puede encontrar el documento.');
        }
        $allFiles = $this->get('media_album_service')->retrieveAllFilesByObject($documento->getFullClassName(), $documento->getId());
        $portada = NULL;
        $archivosFiles = [];
        $normasFiles = [];
        if(isset($allFiles['portada']) && $allFiles['portada'] !== null){
            $portada = array_shift($allFiles['portada']);
        }
        if(isset($allFiles['archivos']) && $allFiles['archivos'] !== null){
            $archivosFiles = $allFiles['archivos'];
        }
        if(isset($allFiles['normas']) && $allFiles['normas'] !== null){
            $normasFiles = $allFiles['normas'];
        }
        return $this->render('default/documento.html.twig', [
            'documento' => $documento,
            'activemenu' => 'documentos',
            'activesubmenu' => $slug,
            'portada' => $portada,
            'archivos' => $archivosFiles,
            'normas' => $normasFiles,
        ]);
    }

    public function buscarAction(Request $request)
    {
        $keyword = $request->query->get('search');
        $trabajos = $this->get('lenguas.trabajos')->doSearch($keyword);
        $documentos = $this->get('lenguas.documentos')->doSearch($keyword);
        var_dump($keyword);
        var_dump(count($trabajos));
        var_dump(count($documentos));
        die;
    }

    public function downloadOriginalFileAction($id)
    {
      $em = $this->getDoctrine()->getManager();
      $file = $em->getRepository("MaithCommonAdminBundle:mFile")->find($id);
      $content = file_get_contents($file->getFullPath());
      $response = new Response();

      /* Figure out the MIME type (if not specified) */
      $known_mime_types = array(
          "pdf" => "application/pdf",
          "txt" => "text/plain",
          "html" => "text/html",
          "htm" => "text/html",
          "exe" => "application/octet-stream",
          "zip" => "application/zip",
          "doc" => "application/msword",
          "xls" => "application/vnd.ms-excel",
          "ppt" => "application/vnd.ms-powerpoint",
          "gif" => "image/gif",
          "png" => "image/png",
          "jpeg" => "image/jpeg",
          "jpg" => "image/jpg",
          "php" => "text/plain"
      );
      $mime_type = $file->getType();
      $file_extension = strtolower(substr(strrchr($file->getName(), "."), 1));
      if(!in_array($file->getType(), $known_mime_types))
      {
        if (array_key_exists($file_extension, $known_mime_types)) {
          $mime_type = $known_mime_types[$file_extension];
        }
      }
      $name = $file->getName();
      if($file->getShowName() !== ''){
      	 $name = $file->getShowName().'.'.$file_extension;
      }
      $response->headers->set('Content-Type', $mime_type);
      $response->headers->set('Content-Disposition', 'attachment;filename="'.$name);

      $response->setContent($content);
      return $response;
    }
}
