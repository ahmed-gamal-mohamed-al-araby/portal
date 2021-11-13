<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Sector;

class OrganizationChartController extends Controller
{
    public function __construct()
    {
        $this->chartData = [];
        $this->currentLanguage = app()->getLocale();
        $this->currentID = 1;
        $this->responsibleEmployee = trans('site.responsible_employee');
        $this->employeeCode = trans('site.Employee_code');
        $this->name = trans('site.Name');
        $this->type = trans('site.Type');
        $this->sector = trans('site.Sector');
        $this->department = trans('site.Department');
        $this->project = trans('site.Project');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
        public function __invoke()
        {
            // dd($this->currentLanguage);
            $_sectors = Sector::with('departments')->with('projects')->with('sectors')->where('parent_id', null)->get();

            $tempSector = [];
            $tempDepartment = [];
            $tempProject = [];
            foreach ($_sectors as $key => $_sector) {
                $sectorName = $_sector['name_' . $this->currentLanguage];

                array_push(
                    $tempSector,
                    collect([
                        'v' => 'S' . $sectorName,
                        'f' => "<div style='font-weight:800; color:#007bff;'>$sectorName</div><div style='color:#6c757d; font-style:italic'>" . $_sector->head['name_' . $this->currentLanguage] . "</div>"
                    ])
                );

                array_push($tempSector, ''); // parent
                array_push($tempSector, 'Parent Sector'); // Tooltip sector

                array_push($this->chartData, $tempSector);
                $tempSector = []; //reset

                // Get children sector
                foreach ($_sector['sectors'] as $key => $childrenSector) {

                    $childrenSectorName = $childrenSector['name_' . $this->currentLanguage];
                    array_push(
                        $tempSector,
                        collect([
                            'v' => 'S' . $childrenSector['name_' . $this->currentLanguage],
                            'f' => "<div style='font-weight:800; color:#17a2b8;'>" . $childrenSector['name_' . $this->currentLanguage] . "</div><div style='color:#6c757d; font-style:italic'>" . $childrenSector->head['name_' . $this->currentLanguage] . "</div>"
                        ])
                    );
                    array_push($tempSector, 'S' . $sectorName); // parent
                    array_push($tempSector, 'Child Sector'); // Tooltip sector

                    array_push($this->chartData, $tempSector);
                    $tempSector = []; //reset
                    // Get sector departments
                    $this->getDepartments($childrenSector, $childrenSectorName);

                    // Get sector projects
                    $this->getProjects($childrenSector, $childrenSectorName);
                }

                // Get sector departments
                $this->getDepartments($_sector, $sectorName);

                // Get sector projects
                $this->getProjects($_sector, $sectorName);

                $tempSector = []; //reset
            }

            $data = json_encode($this->chartData);

            return view('dashboard-views.organization.index', compact('data'));
        }

        public function getDepartments($sector, $partentSectorName)
        {
            $tempDepartment = [];
            // Get sector departments
            foreach ($sector['departments'] as $key => $department) {
                array_push(
                    $tempDepartment,
                    // $department['name_' . $this->currentLanguage]
                    collect([
                        'v' => $department['name_' . $this->currentLanguage],
                        'f' => "<div style='font-weight:800; color:#20c997;'>" . $department['name_' . $this->currentLanguage] . "</div><div style='color:#6c757d; font-style:italic'>" . $department->manager['name_' . $this->currentLanguage] . "</div>"
                    ])
                );
                array_push($tempDepartment, 'S' . $partentSectorName); // parent
                array_push($tempDepartment, 'Department'); // Tooltip sector

                array_push($this->chartData, $tempDepartment);
                $tempDepartment = [];
            }
        }

        public function getProjects($sector, $partentSectorName)
        {
            $tempProject = [];
            foreach ($sector['projects'] as $key => $project) {
                array_push(
                    $tempProject,
                    collect([
                        'v' => $project['name_' . $this->currentLanguage],
                        'f' => "<div style='font-weight:800; color:#fd7e14;'>" . $project['name_' . $this->currentLanguage] . "</div><div style='color:#6c757d; font-style:italic'>" . $project->manager['name_' . $this->currentLanguage] . "</div>"
                    ])
                );
                array_push($tempProject, 'S' . $partentSectorName); // parent
                array_push($tempProject, 'Project'); // Tooltip sector

                array_push($this->chartData, $tempProject);
                $tempProject = [];
            }
        }
    */

    public function __invoke()
    {
        $_sectors = Sector::with('departments')->with('projects')->with('sectors')->with('head')->where('parent_id', null)->get();

        $partentSectorID = 1;

        foreach ($_sectors as $key => $_sector) {
            array_push($this->chartData, collect([
                'id' => $partentSectorID,
                'pid' => null,
                $this->name => $_sector['name_' . $this->currentLanguage],
                $this->type => $this->sector,
                $this->responsibleEmployee => $_sector['head']['name_' . $this->currentLanguage],
                $this->employeeCode => $_sector['head']['code'],
                'img' => asset('dist/img/ceo-default.png'),
                'title' => 'CEO',
            ]));

            // Get children sector
            foreach ($_sector['sectors'] as $key => $childrenSector) {

                array_push($this->chartData, collect([
                    'id' => ++$this->currentID,
                    'pid' => $partentSectorID,
                    $this->name => $childrenSector['name_' . $this->currentLanguage],
                    $this->type => $this->sector,
                    $this->responsibleEmployee => $childrenSector['head']['name_' . $this->currentLanguage],
                    $this->employeeCode => $childrenSector['head']['code'],
                    'img' => asset('dist/img/sector-default.png'),
                    'title' => 'S',
                ]));

                // Get sector departments
                $this->getDepartments($childrenSector, $this->currentID);

                // Get sector projects
                $this->getProjects($childrenSector, $this->currentID);
            }

            // Get sector departments
            $this->getDepartments($_sector, $partentSectorID);

            // Get sector projects
            $this->getProjects($_sector, $partentSectorID);
        }

        $data = json_encode($this->chartData);
        $nodes = json_encode(collect([
            'name' => $this->name,
            'responsibleEmployee' => $this->responsibleEmployee
        ]));
        // return $data;
        return view('dashboard-views.organization.indexorgchart', compact('data', 'nodes'));
    }

    public function getDepartments($sector, $partentSectorID)
    {
        // Get sector departments
        foreach ($sector['departments'] as $department) {
            array_push($this->chartData, collect([
                'id' => ++$this->currentID,
                'pid' => $partentSectorID,
                $this->name => $department['name_' . $this->currentLanguage],
                $this->type => $this->department,
                $this->responsibleEmployee => $department->manager['name_' . $this->currentLanguage],
                $this->employeeCode => $department->manager['code'],
                'img' => asset('dist/img/department-default.png'),
                'title' => 'D',
            ]));
        }
    }

    public function getProjects($sector, $partentSectorID)
    {
        foreach ($sector['projects'] as $project) {

            array_push($this->chartData, collect([
                'id' => ++$this->currentID,
                'pid' => $partentSectorID,
                $this->name => $project['name_' . $this->currentLanguage],
                $this->type => $this->project,
                $this->responsibleEmployee => $project->manager['name_' . $this->currentLanguage],
                $this->employeeCode => $project->manager['code'],
                'img' => asset('dist/img/project-default.png'),
                'title' => 'P',
            ]));
        }
    }
}
