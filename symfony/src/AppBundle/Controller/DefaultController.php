<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Category;

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
   
    public function sitiosinteresAction(Request $request)
    {
        return $this->render('default/sitiosinteres.html.twig', [
            'activemenu' => 'sitiosinteres',
        ]);
    }

    public function otrosmaterialesAction(Request $request)
    {
        $categories = $this->get('lenguas.categories')->retrieveForMenuByType(Category::OTROS);
        return $this->render('default/otrosmateriales.html.twig', [
            'activemenu' => 'otrosmateriales',
            'categories' => $categories,
        ]);
    }

    public function colaboradoresAction(Request $request)
    {
        return $this->render('default/colaboradores.html.twig', [
            'activemenu' => 'colaboradores',
        ]);
    }

    public function menuCategoriasAction(Request $request, $activemenu = '', $activesubmenu = '')
    {
        $this->get('logger')->error($activemenu);
        $this->get('logger')->error($activesubmenu);
        $documents = $this->get('lenguas.documentos')->retrieveAllDocumentsForMenu();
        $categories = $this->get('lenguas.categories')->retrieveForMenu(false);
        $monografias = [];
        $publicaciones = [];
        $fuentes = [];
        if(isset($categories[Category::PUBLICACION])){
          $publicaciones = $categories[Category::PUBLICACION];
        }
        if(isset($categories[Category::MONOGRAFIA])){
          $monografias = $categories[Category::MONOGRAFIA];
        }
        if(isset($categories[Category::FUENTES])){
          $fuentes = $categories[Category::FUENTES];
        }
        return $this->render('default/_menuGeneral.html.twig', [
            'documents' => $documents,
            'monografias' => $monografias,
            'publicaciones' => $publicaciones,
            'fuentes' => $fuentes,
            'activemenu' => $activemenu,
            'activesubmenu' => $activesubmenu,
        ]);
    }

    public function genericosAction(Request $request, $slug)
    {
      $category = $this->get('lenguas.categories')->retrieveBySlug($slug);
      if (!$category) {
            throw $this->createNotFoundException('La categoria no existe');
      }
      $trabajos = $this->get('lenguas.trabajos')->retrieveAllOfCategoryPerLetter($category, $this->get('media_album_service'));
      $returnData = $category->getMenuData();
      $returnData['trabajos'] = $trabajos;
      $returnData['category'] = $category;
      return $this->render('default/trabajosGenerico.html.twig', $returnData);
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
        $trabajos = $this->get('lenguas.trabajos')->doSearch($keyword, $this->get('media_album_service'));
        $documentos = $this->get('lenguas.documentos')->doSearch($keyword);
        return $this->render('default/busqueda.html.twig', [
            'activemenu' => 'busqueda',
            'keyword' => $keyword,
            'trabajos' => $trabajos,
            'documentos' => $documentos,
        ]);
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
